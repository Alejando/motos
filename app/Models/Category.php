<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name','parent_category_id'];
    public function products() {
        return $this->belongsToMany(\DwSetpoint\Models\Product::class);
    }
    
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
    
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_category_id');
    }
    
    private static function getParents($category, &$parents) {        
        $parent = $category->parent;
        if($parent){
            $parents[]=  str_slug($parent->name);
            self::getParents($parent, $parents);
        }
    }
    
    public function getURL() {        
        self::getParents($this, $parents);
        if(is_array($parents)) {
            $parents = array_reverse($parents);
        }
        $parents[] =  str_slug($this->name);
        $url = implode("/", $parents);
        return route('product.getCategoryPage', [
            'slug' => $url,
            'pages'=>1
        ]);
    }

    public static function getRoots($returnQuery = false) {
        $query = self::whereNull('parent_category_id')->get();
        if($returnQuery){
            return $query;
        }
        return $query;
    }
    
}