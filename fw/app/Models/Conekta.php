<?php

namespace DwSetpoint\Models;

include_once __DIR__.'/../../vendor/conekta/conekta-php/lib/Conekta.php';
class Conekta {
    private $currency;
    private $order;
    private $token;
    private $charge;
    protected function getOrder() {
        return $this->order;
    }
    protected function getCharge() {
        return $this->charge;
    }
    public function __construct($order) {
        $this->initContext();
        $this->order = $order;
        $this->currency = 'MXN';
    }
    
    private function initContext () {
        
    }
    
    private $state = false;
    private $infoPspResponse;
    
    public function getState() {
        return $this->order->status;
    }
    
    public function infoResult() {
        return $this->infoPspResponse;
    }
    
    public function getPSPResult($args) {
        
    }
    
    public function setToken ($token) {
        $this->token = $token;
    }
    
    private function getShipmentInfo() {
        $address = $this->order->address;
        $data = [
            'carrier'=> 'estafeta',
            'service'=> 'international',
            'price'=> $this->order->getShipping(),
            'address'=> [
                'street1'=> $address->street . " " .$address->street_number . $address->suite_number,
                'street2'=> $address->neighborhood,
                'street3'=> null,
                'city'=> $address->city,
                'state'=> $address->state->name,
                'zip'=> $address->postal_code,
                'country'=> $address->country->name
            ]
        ];
        return $data;
    }
    protected function checkOutCallback() {}
    private function getListItems(){
        $data = [];
        foreach($this->order->items as  $orderItem){
            $item = [];
            $product = $orderItem->product;
            $item['name'] = $product->name;
            $item['description'] = $product->description;
            $item['unit_price'] = self::getCents($orderItem->getPrice());
            $item['sku'] = $orderItem->stock->code;
            $item['quantity'] = $orderItem->quantity;
            $item['type'] = '';
            $data[] = $item;
        }
        if($this->order->hasCoupon()) {
            $item = [];
            $item['name'] = "Cupon de descuento";
            $item['description'] = "Cupon ".$this->order->coupon->code;
            $item['unit_price'] = self::getCents($this->order->getAmountCoupon());
            $item['sku'] = '';
            $item['quantity'] = 1;
            $item['type'] = '';
            $data[] = $item;
        }
//        if($this->order->requestBill()){
//            $itemIva = [];
//            $itemIva['name'] = 'IVA';
//            $itemIva['description'] = 'IVA';
//            $itemIva['quantity'] = 1;
//            $itemIva['unit_price'] = $this->order->getTaxs();
//            $itemIva['sku'] = 'iva';
//            $data[] = $itemIva;
//        }
        return $data;
    }
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
    private static function getCents($amount) {
        return (int)round($amount * 100);
    }
    protected function setExtraData (&$data) {
        
    }
    public function checkout($extraInfo) {
        \Conekta\Conekta::setApiKey(DBConfig::getConektaPrivateKey());
        \Conekta\Conekta::setLocale('es');
        try {
            $data = [
                'description' => 'Compra Bounce',
                'reference_id'=> 'orden-' . $this->order->id,
                'currency' => $this->currency,
                'card' => $this->token,
                'amount' => self::getCents($this->order->getTotal()),
                'details' => [
                    'name' => $this->order->address->getFullName(),
                    'email' => $this->user->email,
                    'line_items' => $this->getListItems(),
                    'shipment' => $this->getShipmentInfo()
                ]
            ];
            $this->setExtraData($data, $extraInfo);
            $charge = \Conekta\Charge::create($data);
            $this->charge = $charge;
        } catch(\Exception $e) {
            try{
                return  [
                   'error' => true,
                   'message' => $e->message_to_purchaser
               ];
            } catch (\Exception $e2) {
                throw $e;
            }
        }
        if($charge->status == 'paid') {
            $this->order->pspinfo = $charge->__toJSON();
            $this->order->setPaid();
            $this->order->save();
        } else {
            $this->order->reject();
        }
        $this->checkOutCallback();
        return $charge->status == 'paid';
    }
    public function getSuccessUrl () {
        return route('cart.success', [
            'success' => true,
            'order' => $this->order->id
        ]);
    }
}


