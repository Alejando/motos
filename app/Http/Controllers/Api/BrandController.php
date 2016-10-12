<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class BrandController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Brand::class;
    
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
        return \Illuminate\Support\Facades\Response::make($data, 200, ['Content-Type'=>'image/png']);
    }
    
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
    public function store(\Illuminate\Http\Request $request) {
//        print_r(Input::file('icon')); 
        if(Input::get('id')){
            $res = $this->update($request,  Input::get('id'));
        } else {
           $res = parent::store($request);
        }
        if($res['success']) {
//            dd($res['model']);
            $res['model']->saveImg(Input::file('icon'));
//            $this->saveImage(->id);
        }
        return $res;
//        print_r(Input::all()); 
//         phpinfo();
//         die();
//        
//        print_r($_POST);
//        die();
//        parent::store($request);
    }
}