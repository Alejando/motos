<?php

namespace DwSetpoint\Models;
class Product extends \DevTics\LaravelHelpers\Model\ModelBase {

    public function brand() {
        return $this->belongsTo(\DwSetpoint\Models\Brand::class, 'brand_id');
    }

    public function categories() {
        return $this->belongsToMany(\DwSetpoint\Models\Category::class, 'category_id');
    }

    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class, 'stock_id');
    }

}
