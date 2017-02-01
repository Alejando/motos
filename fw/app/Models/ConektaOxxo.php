<?php

namespace DwSetpoint\Models;

class ConektaOxxo extends Conekta {
    
    protected $expireDate = null;
    
    
    
    protected function setExtraData(&$data) {
        $days = DBConfig::getDaysToExpireOrder();
        $today = new \DateTime();
        $today->setTimezone(new \DateTimeZone('America/Mexico_City'));
        $today->setTime(0, 0, 0);
        $today->add(new \DateInterval('P1D'));
        $today->add(new \DateInterval('P' . $days . 'DT0S'));
        $this->expireDate = $today;
        $data['cash'] = [
            'type'=>'oxxo',
            'expires_at' => $today->getTimestamp(),
            'details' => [
                'orden' => $this->getOrder()
            ]
        ];
    }
    
    
    protected function checkOutCallback() {
        $charge = $this->getCharge();
        $dateCarbon = \Carbon\Carbon::createFromTimestamp($charge->payment_method->expires_at);
        ConektaWebhook::create([
            'charge_id' => $charge->id,
            'charge_info' => $charge->__toJSON(),
            'processed' => false,
            'order_id' => $this->getOrder()->id,
            'type' => $charge->payment_method->type,
            'expire_at' => $dateCarbon->toDateTimeString()
        ]);
        $this->getOrder()->pspinfo = $charge->__toJSON();
        $this->getOrder()->save();
        $this->getOrder()->sendFormatOxxo();
    }
    public function getReferenceUrl() {
        return route('cart.conecta-oxxo',[
            'success' => true,
            'order' => $this->getOrder()->id
        ]);
    }
}


