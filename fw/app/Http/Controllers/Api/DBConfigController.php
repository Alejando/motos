<?php

namespace DwSetpoint\Http\Controllers\Api;
class DBConfigController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\DBConfig::class;
    
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
    }
}
