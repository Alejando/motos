<?php

namespace DwSetpoint\Models;
 

class ConektaOxxo extends Conekta {
    protected function setExtraData(&$data) {
        $data['cash'] = [
            'type'=>'oxxo',
            'details' => [
                'orden' => $this->getOrder()
            ]
        ];
    }
    public function getReferenceUrl(){
        dd($this->getCharge());
    }
}