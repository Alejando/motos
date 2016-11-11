<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers\Api;
use DwSetpoint\Models\Content;
use Illuminate\Support\Facades\Input;
/**
 * Description of Coupons
 *
 * @author jdiaz
 */
class CouponController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Coupon::class;

    public function validateCode() {//productValid
        $code = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Coupon::existsCode($code),
            'value' => $code
        ];
    }
}