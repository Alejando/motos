<?php
namespace DwSetpoint\Http\Controllers\Api;

use \Illuminate\Support\Facades\Input;
use \DwSetpoint\Models\Product;
use Illuminate\Support\Facades\File;
class ProductController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Product::class;
    
    // <editor-fold defaultstate="collapsed" desc="+ getImg(Product $id): []<string>|null">
    public function getImgs(Product $id) {
        $product = $id;
        if($product) {
           return $product->imgs;
        }
        abort(404);
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ delteImg(Product $id, $img): []">
    public function deleteImg(Product $id, $img) {
        return self::tryDo(function() use ($id, $img) {
            return "La imagen $img fue eliminada";
        }, 400);
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ editImg(Product $prouct, string $img):[]">
    public function editImg(Product $product, $img) {      
        return self::tryDo(function() use ($product, $img) {
            $newName = Input::get("newName");
            $product->editImg($img, $newName);
            return "La imagen \"$img\" fue renombrada a \"$newName\"";
        });
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ checkStock(Product $id): [] //Ej. sin implementar tryDo">
    public function checkStock($id) {
        $size = Input::get('size');
        $color = Input::get('color');
        $quantity = Input::geT('quantity');
        $product = \DwSetpoint\Models\Product::getById($id);
        try{
            $stock = $product->checkStock($quantity, $size, $color);
            return [
                'success' => true,
                'stock' => $stock
            ];
        }catch(\Exception $ex){
            return [
                'error'=>true,
                'success'=>false,
                'message' => $ex->getMessage()
            ];
        }
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ getCover(integer $id) : String">
    public function getCover($slug, $ext){
        $w = 235;
        $h = 210;
        $product = Product::getBySlug($slug);
        $img = $this->getImgs($product)[0];            
        return $this->img($product, 235, 210, $img); 
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ getCoverSize($id, $width, $height): String">
    public function getCoverSize($id, $width, $height) {
        $img = $this->getImgs($id)[0];
        return $this->img($id, $width, $height, $img);
    }
    // </editor-fold>
    public function getImgFromCache(){
        
    }
    // <editor-fold defaultstate="collapsed" desc="+ img($id,$width,$height,$img): []">
    public function img($slug, $width, $height, $img) {
        
        if(is_a($slug, Product::class)) {
            $product = $slug;
        } else if(is_numeric($slug)) {
            $product = Product::getById($slug);
        } else {
            $product = Product::getBySlug($slug);
        }
        $ext = File::extension($img);
        $file = Product::getImgCacheName($product->slug, $img, $width, $height, $ext);            
        $dirFile = File::dirname($file);
        if(File::exists($file)) {
            \DevTics\LaravelHelpers\Utils\Response::fileContentWithCacheHeaders($file);
        }
        if(!File::exists($dirFile)) {
            File::makeDirectory(File::dirname($file), 493, true);
        }
        
        if($product) {
            $source = $product->image($img, $width, $height);
            $path = $product->getImgPath().$img;
            if($path){
                File::put($file, $source->get($ext));
                $source->show($ext);
                die();
            }
        }
        abort(404);
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ destroy(Product $id): []">
    public function destroy($id) {
        $product =  $product = \DwSetpoint\Models\Product::getById($id);;
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
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ update(\Illuminate\Http\Request $request, int $id): []">
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
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ store(\Illuminate\Http\Request $request): []">
    public function store(\Illuminate\Http\Request $request) {
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
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ getNews(): []">
    public function getNews() {
        $res = \DwSetpoint\Models\Product::orderBy('id', 'desc')->take(8)->get();
        return $res;
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ getDiscounts(): []">
    public function getDiscounts() {
        $res = \DwSetpoint\Models\Product::where('discount_percentage', '>', 0)->get();
        return $res;
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ validateCode(): []">
    public function validateCode() {
        $code = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Product::existsCode($code),
            'value' => $code
        ];
    }
    // </editor-fold>
    
    // <editor-fold defaultstate="collapsed" desc="+ validateSlug(bolean $edit): []">
    public function validateSlug($edit=false) {
        $slug = Input::get('value');
        return [
            'isValid' => !\DwSetpoint\Models\Product::existsSlug($slug),
            'valude' => $slug
        ];
    }
    // </editor-fold>
    
}