<?php

namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class ColorController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Color::class;

    public function validateColor() {
        $color = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Color::existsColor($color),
            'value' => $color
        ];
    }

    public function validatePref() {
        $pref = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Color::existsPref($pref),
            'value' => $pref
        ];
    }

    public function validateRgb() {
        $rgb = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Color::existsRgb($rgb),
            'value' => $rgb
        ];
    }
}