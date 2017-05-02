<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends \DevTics\LaravelHelpers\Model\ModelBase
{
    //
    public function product(){
    	return $this->belongsTo(\DwSetpoint\Models\Product::class);
    }

    public function type(){
    	return  $this->belongsTo(\DwSetpoint\Models\TypeProductFeature::class,'type_product_feature_id');
    }
}
