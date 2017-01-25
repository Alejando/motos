<?php

namespace DwSetpoint\Models;

class ConektaWebhook  extends \DevTics\LaravelHelpers\Model\ModelBase {
    public function order() {    
        return $this->belongsTo(\DwSetpoint\Models\Order::class);    
    }
    public static function getByIdCharge($chargeId,$returnQuery=false) {
        $query= self::where('charge_id', $chargeId);
        if($returnQuery){
            return $query;
        }
        $c= $query->get();
        if($c->count()){
            return $c->get(0);
        }
        return null;
    }
}