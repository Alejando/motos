<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;
use \DwSetpoint\Models\Brand;
class BrandController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Brand::class;
    // <editor-fold defaultstate="collapsed" desc="fitToSize">
    public function fitToSize($id, $slugSEO, $width, $height) {
        $png = $source = Config('app.paths.brads').$id.".png";
        $jpg = $source = Config('app.paths.brads').$id.".jpg";
        $source = file_exists($png) ? $png : $jpg;
        
        $imagine = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $resizeImg = $imagine->open($source)->thumbnail($size,$mode);
        $sizeR  = $resizeImg->getSize();
        $widthR = $sizeR->getWidth();
        $heightR = $sizeR->getHeight();
        $palette = new \Imagine\Image\Palette\RGB();
        $color = $palette->color('#000', 0);
        $preverse = $imagine->create($size, $color);
        $startX = $startY = 0;
        if($widthR < $width) {
            $startX = ($width - $widthR) / 2;
        }
        if($heightR < $height) {
            $startY = ($height - $heightR)/2;
        }
        $preverse->paste($resizeImg, new \Imagine\Image\Point($startX, $startY));
        $data = $preverse->get('png');  
        \DevTics\LaravelHelpers\Utils\Response::dataWithCacheHeaders($data,'image/png');
//        return \Illuminate\Support\Facades\Response::make($data, 200, ['Content-Type'=>]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getImg">
    public function getImg($id) {
        $path = Config('app.paths.brads').$id;
        $jpg = $path.'.jpg';
        $png = $path.'.png';
     
        if(file_exists($jpg)){
            $file = $jpg;
            $mime = 'image/jpg';
        }else if(file_exists($png)){
            $file = $png;
            $mime = 'image/png';
        }else {
            echo "no ta";
            abort(404);
        }
        return response()->file($file);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="destroy">
        public function destroy($id) {
        $res = parent::destroy($id);
        $path = Config('app.paths.brads').$id;
        $jpg = $path.'.jpg';
        $png = $path.'.png';
        $file = false;
        if(file_exists($jpg)){
            $file = $jpg;
        }else if(file_exists($png)){
            $file = $png;
        }
        if($file){
            unlink($file);
        }
        return $res;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="store">
    public function store(\Illuminate\Http\Request $request) {
        $id = Input::get('id');
        if($id){
            $res = $this->update($request,  Input::get('id'));
        } else {
           $res = parent::store($request);
        }
        if($res['success']) {
            $res['model']->saveImg(Input::file('icon'));
        }
        return $res;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="validateBrand">
    public function validateBrand() {//productValid
        $brand = Input::get('value');
        return [
            'isValid' => !Brand::existsBrand($brand),
            'value' => $brand
        ];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getImage">
    public function getImage($id, $width, $height){
        $png = $source = Config('app.paths.brads').$id.".png";
        $jpg = $source = Config('app.paths.brads').$id.".jpg";
        $source = file_exists($png) ? $png : $jpg;
        
        $imagine = new \Imagine\Gd\Imagine();
        $size = new \Imagine\Image\Box($width, $height);
        $mode = \Imagine\Image\ImageInterface::THUMBNAIL_INSET;
        $resizeImg = $imagine->open($source)->thumbnail($size,$mode);
        $sizeR  = $resizeImg->getSize();
        $widthR = $sizeR->getWidth();
        $heightR = $sizeR->getHeight();
        $palette = new \Imagine\Image\Palette\RGB();
        $color = $palette->color('#000', 0);
        $preverse = $imagine->create($size, $color);
        $startX = $startY = 0;
        if($widthR < $width) {
            $startX = ($width - $widthR) / 2;
        }
        if($heightR < $height) {
            $startY = ($height - $heightR)/2;
        }
        $preverse->paste($resizeImg, new \Imagine\Image\Point($startX, $startY));
        $data = $preverse->get('png');  
        return \Illuminate\Support\Facades\Response::make($data, 200, ['Content-Type'=>'image/png']);
    }
    // </editor-fold>
}