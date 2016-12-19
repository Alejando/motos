<?php
namespace DwSetpoint\Models;
class Color  extends \DevTics\LaravelHelpers\Model\ModelBase{

    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class, 'stock_id');
    }

    //Validacion de nombre de color unico
    public static function getValidateUniqueColorURL() {
        return route('color.validateColor');
    }

    public static function existsColor($color) {
        $n = self::where('name', '=', $color)->count();
        return $n>0;
    }
    //Validacion de prefijo de color unico
    public static function getValidateUniquePrefURL() {
        return route('color.validatePref');
    }

    public static function existsPref($pref) {
        $n = self::where('pref', '=', $pref)->count();
        return $n>0;
    }
    //Validacion de RGB de color unico
    public static function getValidateUniqueRgbURL() {
        return route('color.validateRgb');
    }

    public static function existsRgb($rgb) {
        $n = self::where('rgb', '=', $rgb)->count();
        return $n>0;
    }

}
