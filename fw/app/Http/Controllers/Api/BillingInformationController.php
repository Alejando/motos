<?php

namespace DwSetpoint\Http\Controllers\Api;
class BillingInformationController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\BillingInformation::class;    
    public function store(\Illuminate\Http\Request $request) {
        $r = parent::store($request);
        $r['model']->user_id = \Auth::user()->id;
        $r['model']->save();
        return $r;
    }
}