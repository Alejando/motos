<?php

namespace GlimGlam\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Session;
use \Illuminate\Support\Facades\Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class PaypalController extends BaseController {

    private $_api_context;

    public function __construct() {
        // setup PayPal api context
        $paypal_conf = \Config::get('paypal');             
        $this->_api_context = new ApiContext(
                new OAuthTokenCredential(
                    $paypal_conf['client_id'], 
                    $paypal_conf['secret']
                )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    public function checkoutEnrollment($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $currency = 'MXN';
        
        $cover = money_format('%!i', $auction->cover);
        
        $item = new Item();
        $item->setName("Tu lugar en el glimglam en ".$auction->code);
        $item->setCurrency($currency);
        $item->setDescription("descripcion del producto");
        $item->setQuantity(1);
        $item->setPrice($cover);    
        
        $itemsList = new ItemList();
        $itemsList->setItems([$item]);
        
        
//        dd($auction->cover);
         
        $subtotal = $auction->cover;        
        $details = new Details();
        $details->setSubtotal($cover)
                ->setShipping("0.00");
        $total = $subtotal;
        
        $amount = new Amount();
        $amount->setCurrency($currency)
                ->setTotal($total)
                ->setDetails($details);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemsList)
            ->setDescription("Tu lugar en el glimglam ". $auction->title);
        $redirect_url = new RedirectUrls();
        $redirect_url->setReturnUrl(route('enrollment.payment'))
                ->setCancelUrl(route('enrollment.payment'));
        $payment =  new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_url)
                ->setTransactions([$transaction])
        ;
        try {           
            $payment->create($this->_api_context);
        } catch(\PayPal\Exception\PayPalConnectionException $ex){
            if(\Config::get('app.debug')){
                echo "Exception" . $ex->getMessage() . PHP_EOL;
                 dd(json_decode($ex->getData(),true));
            } else {
                die("Error al comunicarse con PayPal");
            }
        }
        $approvalLink = $payment->getApprovalLink();
        \Session::put('paypal_payment_id', $payment->getId());
        \Session::put('payment_auction_code', $code);
        $ggPayment = new \GlimGlam\Models\Payment([
            'user' => \Illuminate\Support\Facades\Auth::User()->id,
            'folio' => time(),
            'date_at' => new \DateTime(),
            'description' => 'Asiento para '.$code,
            'type' => \GlimGlam\Models\Payment::TYPE_ENROLLMENT,
            'approved' => null,
            'auction' => $auction->id,
            'provider' => \GlimGlam\Models\Payment::PROVIDER_PAYPAL
        ]);
        $ggPayment->setAmountTotal($auction->cover);
        $ggPayment->save();
        \Session::put('payment_temp',$ggPayment->id);
        if(isset($redirect_url)) {
            return \Redirect::away($approvalLink);
        }
        return "Paso algo al intentar conectar con paypayl";
    }
    
    public function enrrolmentPaymentStatus() {
        $user = \Auth::User();        
        $args['user'] = $user;
        $args['to'] = 'wariodiaz@gmail.com';
        $code = \Session::get('payment_auction_code');        
             
        \GlimGlam\Libs\Helpers\Mail::payment($args);
        $payment_id = \Session::get('paypal_payment_id');
        \Session::forget('paypal_payment_id');
        \Session::forget('payment_auction_code');   
        $payerId =  Input::get('PayerID');
        $token = Input::get('token');
        if(empty($payerId) || empty($token)){
            return "Algo paso al intentar conectar con PayPal";
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        $result = $payment->execute($execution, $this->_api_context);
//        return $result->toJSON();
        if($result->getState() == 'approved') {
            $idPayment = \Session::get('payment_temp');
            $ggPayment = \GlimGlam\Models\Payment::getById($idPayment);
            $ggPayment->approved = true;
            $ggPayment->api_info = $api_info = $result->toJSON();
            $ggPayment->save();
            
            $auction = \GlimGlam\Models\Auction::getByCode($code);
            $enrollment = new \GlimGlam\Models\Enrollment([
                'user' => $user->id,
                'auction' => \GlimGlam\Models\Auction::getByCode($code)->id,
                'cover' => $auction->cover,
                'bids' => $auction->bids,
                'offer' => 0,
            ]);
            $enrollment->save();
            Session::forget('payment_temp');
            return \redirect(route('auction.payment.approvated'));
        }
        
        return \redirect(route('acution.payment.approvate'));
    }

}
