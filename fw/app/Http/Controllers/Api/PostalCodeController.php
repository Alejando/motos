<?php

namespace DwSetpoint\Http\Controllers\Api;
use \Illuminate\Support\Facades\Input;
class PostalCodeController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\PostalCode::class;
    public function byCpGroup($id) {
        return \DwSetpoint\Models\PostalCode::where('postal_code_group_id', '=', $id)->get();
    }
    public function saveGroup() {
        $cps = Input::get('cps');
        $group = Input::get('group');
        $cps = explode(" ", $cps);
        $ids = [];
        foreach($cps as $cp){
            $obCp = \DwSetpoint\Models\PostalCode::create([
                'code' => trim($cp),
                'postal_code_group_id' => $group
            ]);
            $ids[] = $obCp->id;
        }
        return $ids;
    }
}