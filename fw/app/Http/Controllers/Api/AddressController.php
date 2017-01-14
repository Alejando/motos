<?php

namespace DwSetpoint\Http\Controllers\Api;
use \DwSetpoint\Models\Address;
class AddressController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = Address::class;
    public function store(\Illuminate\Http\Request $request) {
        $r = parent::store($request);
        $r['model']->user_id = \Auth::user()->id;
        $r['model']->save();
        return $r;
    }
    
    public function getShippingRules($address_id) {
        $data = Address::getShippingRules(
            $address_id
        );
        return $data;
    }
}