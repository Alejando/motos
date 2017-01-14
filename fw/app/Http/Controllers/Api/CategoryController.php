<?php
use Illuminate\Support\Facades\Log;
namespace DwSetpoint\Http\Controllers\Api;
use Illuminate\Support\Facades\Input;
use Log;
class CategoryController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Category::class;
    public function tree () {
        
        $all = \DwSetpoint\Models\Category::getAll();
        $res = [[
                'id' => 'root',
                'parent' => "#",
                'text' => 'Categorias',
                'type' => 'root',
                'selected'=>true,
                'state' => [
                    'selected' => false,
                    'opened' => true
                ]
            ]
        ];
        foreach($all as $category){
            $paret = $category->parent_category_id;
            $res[] = [
                'id' => $category->id,
                'text'=> $category->name,
                'parent' => $paret ? $paret : 'root' ,
                'state' => [
                    'selected' => false,
                    'opened' => true
                ]
            ];
        }
        return $res;
    }
    
    public function destroy($id) {
        $category = \DwSetpoint\Models\Category::where('parent_category_id', $id);
        if($category->count()){
            return [
                'success' => false,
                'error' => true,
                'msj' => "No se puede eliminar una categoria con sub-categorias"
            ];
        }
        return parent::destroy($id);
    }

    public function validateCategory() {//productValid
        $category = Input::get('value');
        // Log::info('Showing user profile for user: '.$category);
        return [
            'isValid' => !\DwSetpoint\Models\Category::existsCategory($category),
            'value' => $category
        ];
    }

    public function store(\Illuminate\Http\Request $request) {

        if(Input::get('id')){
            $res = $this->update($request,  Input::get('id'));
        } else {
           $res = parent::store($request);
        }
        if($res['success']) {
           // dd($res['model']);
            $res['model']->saveImg(Input::file('icon'));
           // $this->saveImage(->id);
        }
        return $res;
       // print_r(Input::all()); 
       //  phpinfo();
       //  die();
       
       // print_r($_POST);
       // die();
       // parent::store($request);
    }

    public function getImage($id, $width, $height){
        $png = $source = Config('app.paths.categories').$id.".png";
        $jpg = $source = Config('app.paths.categories').$id.".jpg";
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

    public function getPlayersTennis(){
        $players = \DwSetpoint\Models\Category::where('parent_category_id', '!=', NULL)->where('type', 1)->get();

        return($players);
        // return "players";
    }
}