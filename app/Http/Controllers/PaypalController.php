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
    public function checkout($code) {
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user = \Auth::user();
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $currency = 'MXN';
        $bid = \GlimGlam\Models\Bid::where('user','=', $user->id)
            ->where('auction', '=', $auction->id)->orderBy('bid_at','desc')
            ->take(1)
            ->get()->get(0);
        $amount = (float)$bid->amount;

//        $amount = 1000;
        $iva = ($amount -($amount /1.16));
        $subTotal = $amount - $iva;
        $shiping = 100;
        $total = $subTotal + $iva;
        $item = new Item();
        $item->setName($auction->title);
        $item->setCurrency($currency);
        $item->setDescription($auction->description);
        $item->setQuantity(1);
        $item->setPrice($subTotal);
        
        $itemIva = new Item();
        $itemIva->setName('IVA');
        $itemIva->setCurrency($currency);
        $itemIva->setDescription('ss');
        $itemIva->setQuantity(1);
        $itemIva->setPrice($iva);
        
        $tiemList = new ItemList();
        $tiemList->setItems([$item, $itemIva]);
        $details = new Details();
        $details->setSubtotal($total);        
        $details->setShipping($shiping);
        $totalFinal = $total + $shiping;
        
        $obAmount = new Amount();
        $obAmount->setCurrency($currency)
                ->setTotal($totalFinal)
                ->setDetails($details);
        
        $transaction = new Transaction();
        $transaction->setAmount($obAmount);
        $transaction->setItemList($tiemList);
        $transaction->setDescription('Tu subasta en glimgam ' . $auction->title);
        
        $redirect_url = new RedirectUrls();
        $redirect_url->setReturnUrl(route('auction.finish-payment',[
                'code' => $code
            ]))
            ->setCancelUrl(route('auction.finish-payment', [
                'code' => $code
            ]));
        $payment = new Payment();
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
            'description' => 'Pago de la subasta '.$code,
            'type' => \GlimGlam\Models\Payment::TYPE_PAY_WIN,
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
    public function checkoutEnrollment($code, $bill) {
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
        \Session::put('bill', $bill === 'true' );
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
            
            return \Redirect($approvalLink);
        }
        return "Paso algo al intentar conectar con paypayl";
    }
    
    public function enrolmentPaymentStatus() {
        $code = \Session::get('payment_auction_code');                     
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user = \Auth::User();
        $payment_id = \Session::get('paypal_payment_id');
        \Session::forget('paypal_payment_id');
//        \Session::forget('payment_auction_code');   
        $bill = \Session::get('bill');   
        $payerId =  Input::get('PayerID');
        $token = Input::get('token');
        if(empty($payerId) || empty($token)){
            return "Algo paso al intentar conectar con PayPal";
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        $result = $payment->execute($execution, $this->_api_context);
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
            if($bill){
                $info = $user->billsInfo;
                $requestBillData = [
                    'rfc' => $info->rfc,
                    'business_name' =>  $info->business_name,
                    'address' => $info->address,
                    'neighborhood' => $info->neighborhood,
                    'postal_code' => $info->postal_code,
                    'city' => $info->city,
                    'state' => $info->state,
                    'user_id' => $user->id,
                    'type' => \GlimGlam\Models\RequestBill::TYPE_BY_ENROLLMENT,
                    'enrollment_id' => $enrollment->id,
                    'invoiced' => false
                ];
                \GlimGlam\Models\RequestBill::create($requestBillData);
                Session::forget('bill');
            }
            $auction->sendEmailEnrolment($user, $ggPayment);
            Session::forget('payment_temp');
            Session::put('insertLeadFB', true);
            return \redirect(route('auction.payment.approvated'));
        }
        return \redirect(route('auction.payment.failed'));
    }

}
