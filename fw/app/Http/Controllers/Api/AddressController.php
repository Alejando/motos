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
    
    public function show($id) {
        $user = auth()->user();
        if($user) {
            if(!$user->isAdmin()){
                return parent::show($id);
            } else {
                $address = parent::show($id);
                if($address->user == $user) {
                    return $address;
                }
            }
        }
        abort(404,"No se encontro la direccion o bien no corresponde al usuario");
    }
}