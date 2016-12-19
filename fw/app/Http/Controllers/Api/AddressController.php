<?php

namespace DwSetpoint\Http\Controllers\Api;
class AddressController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Address::class;
    public function store(\Illuminate\Http\Request $request) {
        $r = parent::store($request);
        $r['model']->user_id = \Auth::user()->id;
        $r['model']->save();
        return $r;
    }
}