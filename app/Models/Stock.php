<?php
namespace DwSetpoint\Models;
class Stock extends \DevTics\LaravelHelpers\Model\ModelBase {

    public function product() {
        return $this->belongsTo(\DwSetpoint\Models\Product::class, 'product_id');
    }

    public function color() {
        return $this->belongsTo(\DwSetpoint\Models\Color::class, 'color_id');
    }

    public function size() {
        return $this->belongsTo(\DwSetpoint\Models\Size::class, 'size_id');
    }

}