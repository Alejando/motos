<?php

namespace DwSetpoint\Models;
class PSP {
    
    const PAYPAL = 1;
    const CONEKTA = 2;
    const STATE_APPROVED = 1;
    const STATE_REJECT = 2;
    
    
    
    public static function createByOrder($order) {
        switch ($order->psp){
           case self::PAYPAL :
               return new PayPal($order);
           case self::CONEKTA:
               return new Conekta($order);
               
        }
    }
    
}