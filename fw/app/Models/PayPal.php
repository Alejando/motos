<?php

namespace DwSetpoint\Models;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PayPal {
    private $payer;
    private $currency;
    private $order;
    private $_api_context;
    
    public function __construct($order) {
        $this->initContext();
        $this->order = $order;
        $this->payer = new Payer();
        $this->payer->setPaymentMethod('paypal');
        $this->currency = 'MXN';
    }
    
    private function initContext () {
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(
                new OAuthTokenCredential(
                    $paypal_conf['client_id'],
                    $paypal_conf['secret']
                )
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
    }
    
    private $state = false;
    private $infoPspResponse;
    
    public function getState() {
        return $this->state;
    }
    
    public function infoResult() {
        return $this->infoPspResponse;
    }
    
    public function getPSPResult($args) {
        $paypal_payment_id = \Session::get('paypal_payment_id');
        $payerId = $args['PayerID'];
        $payment = Payment::get($paypal_payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);
        $result = $payment->execute($execution, $this->_api_context);
        $this->infoPspResponse;
        if($r = ($result->getState() == 'approved')) {
            $this->state = PSP::STATE_APPROVED;
            $this->order->status = Order::STATUS_PAYMED;
        } else {
            dd($r);
        }
        $this->infoPspResponse = $result->toJSON();
        $this->order->pspinfo = $this->infoPspResponse;
        $this->order->save();
        return $this;
    }
    
    public function getCheckoutURL() {
        $order = $this->order;
//        $amount = $order->getAmount();
        $coupon = $order->coupon;
//        $subTotal = $order->getSubTotal();
        $paypalItems = [];
        foreach($order->items as  $orderItem){
            $paypalItem = new \PayPal\Api\Item();
            $product = $orderItem->product;
            $paypalItem->setName($product->name);
            $paypalItem->setCurrency($this->currency);
            $paypalItem->setDescription($product->description);
            $paypalItem->setQuantity($orderItem->quantity);
            $paypalItem->setPrice($orderItem->getPrice());
            $paypalItems[] = $paypalItem;
        }
        if($order->hasCoupon()) {
            $paypalItem = new \PayPal\Api\Item();
            $product = $orderItem->product;
            $paypalItem->setName("Cupon");
            $paypalItem->setCurrency($this->currency);
            $paypalItem->setDescription("Descuento");
            $paypalItem->setQuantity(1);
            $paypalItem->setPrice($order->getAmountCoupon()*-1);
            $paypalItems[] = $paypalItem;
        }
//        if($order->requestBill()){
//            $itemIva = new Item();
//            $itemIva->setName('IVA');
//            $itemIva->setCurrency($this->currency);
//            $itemIva->setDescription('IVA');
//            $itemIva->setQuantity(1);
//            $itemIva->setPrice($order->getTaxs());
//            $paypalItems[] = $itemIva;
//        }
        $itemList = new ItemList();
        $itemList->setItems($paypalItems);
        $details = new Details();
        $details->setSubtotal($order->getSubtotal()-$order->getAmountCoupon());
        $details->setShipping($order->getShipping());
        $totalTransaction = $order->getTotal();
       
        $obAmount = new Amount();
        $obAmount->setCurrency($this->currency)
                ->setTotal($totalTransaction)
                ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($obAmount);
        $transaction->setItemList($itemList);
        
        $transaction->setDescription('Compra Bounce ');
        $redirect_url = new RedirectUrls();
        
        
        $redirect_url->setReturnUrl(
            route('cart.success', [ 
                'order' => $order->id,
                'success' => true
            ]))
            ->setCancelUrl('http://demo.estrasol.com.mx/setpoint/carrito/paypal-success?order=' . $order->id . '&success=false');
        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($this->payer)
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
        \Session::put('paypal_payment_id', $payment->getId());
        $approvalLink = $payment->getApprovalLink();
        if(isset($redirect_url)) {
            return $approvalLink;
        }
    }
}