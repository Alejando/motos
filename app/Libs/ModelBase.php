<?php

namespace DwSetpoint\Libs\CoreUtils;
use Illuminate\Database\Eloquent\Model;
class ModelBase extends Model {
    use \DwSetpoint\Libs\CoreUtils\traits\MethodsModelBase;
    protected $guarded = ['id'];    
    public $timestamps = false;
    
}
