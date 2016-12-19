<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class SizeController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Size::class;

    public function validateSize() {
        $size = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Size::existsSize($size),
            'value' => $size
        ];
    }
}