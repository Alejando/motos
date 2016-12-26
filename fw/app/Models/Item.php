<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends \DevTics\LaravelHelpers\Model\ModelBase {
    
    public function product() {    
        return $this->belongsTo(\DwSetpoint\Models\Product::class);    
    }
    public function getPrice() {
        return 100;
    }
    
}