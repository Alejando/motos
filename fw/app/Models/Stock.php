<?php
namespace DwSetpoint\Models;
class Stock extends \DevTics\LaravelHelpers\Model\ModelBase {

    public $timestamps = true;
    public function product() {
        return $this->belongsTo(\DwSetpoint\Models\Product::class);
    }

    public function color() {
        return $this->belongsTo(\DwSetpoint\Models\Color::class);
    }

    public function size() {
        return $this->belongsTo(\DwSetpoint\Models\Size::class);
    }
    
    public static function find($product_id, $color_id = false, $size_id = false) {
        /* @var $squery \Illuminate\Database\Query\Builder */
        $query = Stock::where('product_id', '=', $product_id);
        if($color_id!= '0') {
            $query->where('color_id', '=', $color_id);
        } else {
            $query->whereNull('color_id');
        }
        if($size_id != '0') {
            $query->where('size_id', '=', $size_id);
        } else {
            $query->whereNull('size_id');
        }
        $collection = $query->get();
        
        if($res = $collection->get(0)){
            return $res;
        }
        return null;
    }
    public function getPrice() {
        $discount = $this->product->discount_percentage;
        if($discount){
           $price = $this->price;
           return $price - (($price/100) * $discount);
        }
        return $this->price;
    }
}
