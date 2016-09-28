<?php
namespace DwSetpoint\Models;
class Color  extends \DevTics\LaravelHelpers\Model\ModelBase{
    
    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class, 'stock_id');
    }

}