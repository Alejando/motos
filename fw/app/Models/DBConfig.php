<?php

namespace DwSetpoint\Models;

class DBConfig  extends \DevTics\LaravelHelpers\Model\ModelBase {
    public static function getValue($code, $defaultValue = '') {
        $conf = self::where('code', '=', $code)->get();
        if($conf->count()) {
            return $conf->get(0)->value;
        }
        return $defaultValue;
    }
    public static function __callStatic($method, $parameters) {
        if($method!='get' && strpos($method,'get')===0){
            $code = snake_case(substr($method,3),"-");
            return self::getValue($code);
        }
        return parent::__callStatic($method, $parameters);
    }
}   