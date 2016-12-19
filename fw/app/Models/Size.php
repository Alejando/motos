<?php
namespace DwSetpoint\Models;
class Size  extends \DevTics\LaravelHelpers\Model\ModelBase{

    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class, 'stock_id');
    }

    public static function getValidateUniqueSizeURL() {
        return route('size.validateSize');
    }

    public static function existsSize($size) {
        $n = self::where('name', '=', $size)->count();
        return $n>0;
    }
    
}