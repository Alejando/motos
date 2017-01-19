<?php

namespace DwSetpoint\Http\Controllers\Api;
class BillingInformationController extends \DevTics\LaravelHelpers\Rest\ApiRestController {

    protected static $model = \DwSetpoint\Models\BillingInformation::class;    

    public function store(\Illuminate\Http\Request $request) {
        $data = \Illuminate\Support\Facades\Input::all();
        $data['user_id'] = auth()->user()->id;
        $obj = \DwSetpoint\Models\BillingInformation::create($data);
        return ['success' => true, 'model'=> $obj];
    }
    
}