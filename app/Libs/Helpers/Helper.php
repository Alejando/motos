<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Libs\Helpers;

/**
 * Description of Currency
 *
 * @author jdiaz
 */
class Helper {
    
    private $currency = '';
    
    public function setCurrency($currency) {
        $this->currency = $currency;
    }
    
    public function getCurrency() {
        return $this->currency ? $this->currency : Config('app.currency');
    }

    public function get($data = []) {
        echo "food";
    }
    
}
