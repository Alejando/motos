<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name'];
    public function products() {
        return $this->hasMany(\DwSetpoint\Models\Product::class, 'product_id');
    }

}