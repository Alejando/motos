<?php


namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;

class BrandController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Brand::class;
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