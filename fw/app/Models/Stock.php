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

}
