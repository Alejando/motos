<?php
namespace DwSetpoint\Http\Controllers\Api;

use \Illuminate\Support\Facades\Input;

class ProductController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Product::class;
    public function getImgs($id) {
        $product = \DwSetpoint\Models\Product::getById($id);
        if($product) {
           return $product->imgs;
        }
        abort(404);
    }
    public function img($id,$width,$height,$img) {
        $product = \DwSetpoint\Models\Product::getById($id);
        if($product) {
            $source = $product->image($img,$width,$height);
            $path = $product->getImgPath().$img;
            if($path){
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $source->show($ext);
                die();
            }
        }
        abort(404);
    }
    public function store(\Illuminate\Http\Request $request) {
        $res = parent::store($request);
        /* @var $product \DwSetpoint\Models\Product */
        $product = $res['model'];
        $product->saveUploadImgs(Input::file('img'))
            ->setColorsByIds(Input::get('colors'))
            ->setCategoriesByIds(Input::get('categories'))
        ;
        return $res;
//        try{
//            $files = ;
//            foreach($files as $file) {
//                https://packagist.org/packages/devtics/laravel-helpers
//            }
//        }catch(\Exception $ex){
//            echo $ex->getMessage();
//        }dd($file);
        die("--");
        //parent::store($request);
    }
}