<?php

namespace DwSetpoint\Models;

class DBConfig  extends \DevTics\LaravelHelpers\Model\ModelBase {
    public static function getValue($code, $defaultValue = '') {
        $conf = self::where('code', '=', $code)->get();
        if($conf->count()) {
            $value = $conf->get(0)->attributes['value'];
            if($conf->get(0)->type == "integer"){             
                return (int)$value;            
            }
            return $value;
        }
        throw new \Exception("No se encotro la configuracion $code ");
    }
    public static function __callStatic($method, $parameters) {
        if($method!='get' && strpos($method,'get')===0){
            $code = snake_case(substr($method,3),"-");
            return self::getValue($code);
        }
        return parent::__callStatic($method, $parameters);
    }
    public function getValueAttribute() {
        if($this->type=="secret"){
            $value = $this->attributes['value'];
            return substr($value,0,3)."...".substr($value, strlen($value)-4);
        }
        
        return $this->attributes['value'];
    }
}   