<?php

namespace DwSetpoint\Http\Controllers\Api;
class CategoryController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Category::class;
    public function tree () {
        
        $all = \DwSetpoint\Models\Category::getAll();
        $res = [[
                'id' => 'root',
                'parent' => "#",
                'text' => 'Categorias',
                'type' => 'root',
                'state' => [
                    'opened' => true
                ]
            ]
        ];
        foreach($all as $category){
            $paret = $category->parent_category_id;
            $res[] = [
                'id' => $category->id,
                'text'=> $category->name,
                'parent' => $paret ? $paret : 'root' 
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
}