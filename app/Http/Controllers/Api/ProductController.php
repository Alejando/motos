<?php


namespace DwSetpoint\Http\Controllers\Api;
class ProductController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Product::class;
    
    public function store(\Illuminate\Http\Request $request) {
        dd($_FILES);
        die("--");
        //parent::store($request);
    }
}