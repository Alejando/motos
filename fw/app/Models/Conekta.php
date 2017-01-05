<?php

namespace DwSetpoint\Models;

include_once __DIR__.'/../../vendor/conekta/conekta-php/lib/Conekta.php';
class Conekta {
    private $currency;
    private $order;
    private $token;
    
    public function __construct($order) {
        $this->initContext();
        $this->order = $order;
        if($order->paid){
            $this->state = true;
        }
        $this->currency = 'MXN';
    }
    
    private function initContext () {
        
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
    private function getListItems(){
        $data = [];
        foreach($this->order->items as  $orderItem){
            $item = [];
            $product = $orderItem->product;
            $item['name'] = $product->name;
            $item['description'] = $product->description;
            $item['unit_price'] = $orderItem->getPrice();
            $item['sku'] = $orderItem->stock->code;
            $item['quantity'] = $orderItem->quantity;
            $item['type'] = '';
            $data[] = $item;
        }
        
        if($this->order->requestBill()){
            $itemIva = [];
            $itemIva['name'] = 'IVA';
            $itemIva['description'] = 'IVA';
            $itemIva['quantity'] = 1;
            $itemIva['unit_price'] = $this->order->getIva();
            $itemIva['sku'] = 'iva';
            $data[] = $itemIva;
        }
        return $data;
    }
    public function setUser($user) {
        $this->user = $user;
        return $this;
    }
    public function checkout() {
        \Conekta\Conekta::setApiKey("key_eazzCz6tXkZy7t7TC1SbJQ");
        \Conekta\Conekta::setLocale('es');
        try {
            $data = [
                'description' => 'Compra Bounce',
                'reference_id'=> 'orden-' . $this->order->id,
                'currency' => $this->currency,
                'card' => $this->token,
                'amount' => $this->order->getTotalWhitShpping(),
                'details' => [
                    'name' => $this->order->address->getFullName(),
                    'phone' => $this->order->address->tel,
                    'email' => $this->user->email,
                    'line_items' => $this->getListItems(),
                    'shipment' => $this->getShipmentInfo()
                ]
            ];
            $charge = \Conekta\Charge::create($data);
        } catch(\Exception $e) {
//            throw $e;
             return  [
                'error' => true,
                'message' => $e->message_to_purchaser
            ];
        }
        if($charge->status == 'paid') {
            $this->order->pspinfo = $charge->__toJSON();
            $this->order->paid = true;
            $this->order->save();
        }
        return $charge->status == 'paid';
    }
    public function getSuccessUrl () {
        return route('cart.success',[
            'success' => true,
            'order' => $this->order->id
        ]);
    }
}


