<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends \DevTics\LaravelHelpers\Model\ModelBase {
    const STATUS_PAYMED = 1;
    const STATUS_STAN_BY = 2;
    const STATUS_CANCEL = 3;
    
    
    public function setItems() {
        
    }
    
    public function setPSP($psp) {
        $this->sps = $sps;
    }
    
    
    
}