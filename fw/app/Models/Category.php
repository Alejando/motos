<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name','parent_category_id'];
    public static function findChildrenBySlug($parent, $categorySlug) {
        $query = \DwSetpoint\Models\Category::where('name', 'like',  ucwords(str_replace('-', " ", $categorySlug)));
        if($parent!==null){
            $query->where('parent_category_id','=', $parent->id);
        }
        $category = $query->get();
        if($category->count()) {
            return $category->get(0);
        } 
        return null;
    }
    // <editor-fold defaultstate="collapsed" desc="getBySlug">
    public static function getBySlug($slug) {
        $expoSlug = explode("/", $slug);
        $category = null;
        foreach($expoSlug as $categoryslug) {
            $r = self::findChildrenBySlug($category,$categoryslug);
            $category = $r;
        }
        return $category;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="products">
    public function products() {
        return $this->belongsToMany(\DwSetpoint\Models\Product::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="parent">
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="subcategories">
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_category_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getParents}">
    public static function getParents($category, &$parents) {        
        if($category){
            $parent = $category->parent;
            if($parent){
                $parents[]=  str_slug($parent->name);
                self::getParents($parent, $parents);
            }
        }        
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getURL">
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
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRoots">
    public static function getRoots($returnQuery = false) {
        $query = self::whereNull('parent_category_id')->get();
        if($returnQuery){
            return $query;
        }
        return $query;
    }

    public static function getValidateUniqueCategoryURL() {
        return route('category.validateCategory');
    }

    public static function existsCategory($category) {
        $n = self::where('name', '=', $category)->count();
        return $n>0;
    }

    // </editor-fold>
}