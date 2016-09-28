<?php
namespace DwSetpoint\Models;
class Stock extends \DevTics\LaravelHelpers\Model\ModelBase {    
/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'stock';

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