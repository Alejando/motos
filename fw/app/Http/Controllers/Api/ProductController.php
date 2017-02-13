<?php
namespace DwSetpoint\Http\Controllers\Api;

use \Illuminate\Support\Facades\Input;
use \DwSetpoint\Models\Product;
class ProductController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Product::class;

    public function getImgs($id) {
        $product = \DwSetpoint\Models\Product::getById($id);
        if($product) {
           return $product->imgs;
        }
        abort(404);
    }
    
    public function deleteImg(Product $id, $img) {
        return self::tryDo(function() use ($id, $img) {
//            $id->removeImg($img);
            return "La imagen $img fue eliminada";
        }, 400);
    }
    
    public function editImg(Product $product, $img) {      
        return self::tryDo(function() use ($product, $img) {
            $newName = Input::get("newName");
            $product->editImg($img, $newName);
            return "La imagen \"$img\" fue renombrada a \"$newName\"";
        });
    }
    
    public function checkStock($id) {
        $size = Input::get('size');
        $color = Input::get('color');
        $quantity = Input::geT('quantity');
        $product = \DwSetpoint\Models\Product::getById($id);
        try{
            $stock = $product->checkStock($quantity, $size, $color);
            return [
                'success' => true,
                'stock' => $stock->id
            ];
        }catch(\Exception $ex){
            return [
                'error'=>true,
                'success'=>false,
                'message' => $ex->getMessage()
            ];
        }
    }

    public function getCover($id){
        $img = $this->getImgs($id)[0];
        $this->img($id, 235, 210, $img);
    }
    public function getCoverSize($id, $width, $height) {
        $img = $this->getImgs($id)[0];
        return $this->img($id, $width, $height, $img);
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

    public function destroy($id) {
        $product = \DwSetpoint\Models\Product::getById($id);
        $product->removePath();
        if($product->hasOrders()) {
            $res = [
                'error' => true,
                'message' => "El producto ha sido comprado, no se pueden eliminar productos con ordenes",
                'no_error' => 1
            ];
            return response()->json($res, 400);
        }
        return parent::destroy($id);
    }

    public function update(\Illuminate\Http\Request $request, $id) {
        $oldCode = \DwSetpoint\Models\Product::getById($id)->code;
        $res = parent::update($request, $id);
        if($oldCode != Input::get('code')){
            $res['model']->updatePathUpload($oldCode);
        }
        $res['model']->setColorsByIds(Input::get('colors'))
            ->setCategoriesByIds(Input::get('categories'))
            ->setSizesByIds(Input::get('sizes'));
        return $res;
    }

    public function store(\Illuminate\Http\Request $request) {
//        dd(Input::all());
        $id = Input::get("id");
        if($id) {
            $oldCode = \DwSetpoint\Models\Product::getById($id)->code;
            $res = parent::update($request, $id);
            $res['model']->updatePathUpload($oldCode);
        } else {
            $res = parent::store($request);
        }
        /* @var $product \DwSetpoint\Models\Product */
        $product = $res['model'];
        $product->saveUploadImgs(Input::file('img'))
            ->setColorsByIds(Input::get('colors'))
            ->setCategoriesByIds(Input::get('categories'))
            ->setSizesByIds(Input::get('sizes'));
        ;
        return $res;
    }

    public function getNews() {
        $res = \DwSetpoint\Models\Product::orderBy('id', 'desc')->take(8)->get();
        return $res;
    }

    public function getDiscounts() {
        $res = \DwSetpoint\Models\Product::where('discount_percentage', '>', 0)->get();
        return $res;
    }

    public function validateCode() {//productValid
        $code = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Product::existsCode($code),
            'value' => $code
        ];
    }
    public function validateSlug($edit=false) {
        $slug = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Product::existsSlug($slug),
            'valude' => $slug
        ];
    }

}