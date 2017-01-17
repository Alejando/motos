<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends \DevTics\LaravelHelpers\Model\ModelBase {
    
    public function product() {    
        return $this->belongsTo(\DwSetpoint\Models\Product::class);    
    }
    
    public function order() {    
        return $this->belongsTo(\DwSetpoint\Models\Order::class);    
    }
    
    public function stock() {
        return $this->belongsTo(\DwSetpoint\Models\Stock::class);    
    }
    
    public function getPrice() {
        $product = $this->product;
        if($product->discount_percentage){//hay descuento por producto
             $price = $this->price - (($this->price/100) * $product->discount_percentage);
        }else {
            $price = $this->price;
        }
        return $price;
    }
    
}