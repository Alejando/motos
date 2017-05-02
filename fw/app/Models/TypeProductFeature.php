<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class TypeProductFeature extends \DevTics\LaravelHelpers\Model\ModelBase
{
    public function features(){
        return $this->hasMany(\DwSetpoint\Models\ProductFeature::class);
    }

}
