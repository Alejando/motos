<?php
namespace DwSetpoint\Http\Controllers\Api;

use \Illuminate\Support\Facades\Input;

class ProductController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Product::class;
    
    public function store(\Illuminate\Http\Request $request) {
        $res = parent::store($request);
        /* @var $product \DwSetpoint\Models\Product */
        $product = $res['model'];
        $product->saveUploadImgs(Input::file('img'));
//        try{
//            $files = ;
//            foreach($files as $file) {
//                
//            }
//        }catch(\Exception $ex){
//            echo $ex->getMessage();
//        }dd($file);
        die("--");
        //parent::store($request);
    }
}