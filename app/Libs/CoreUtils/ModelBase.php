<?php

namespace GlimGlam\Libs\CoreUtils;
use Illuminate\Database\Eloquent\Model;
class ModelBase extends Model {
    use \GlimGlam\Libs\CoreUtils\traits\MethodsModelBase;
    protected $guarded = ['id'];    
    public $timestamps = false;
    
}
