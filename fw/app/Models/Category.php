<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name','parent_category_id', 'type', 'hidden'];

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
    // public function setTypeAttribute($type){
    //     $this->attributes['type'] = $type !== 'false';
    // }
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
    // Condicion where es para filtrar las categorias que estan ocultas
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_category_id')->where('hidden', 0);
    }
    // </editor-fold>
    public function hasSubcategories() {
        return self::where('parent_category_id','=', $this->id)->count() > 0;
    }
    
    public function getSubcategoriesIds(&$ids, $idCategory = false) {
        if($idCategory==false) {
            $idCategory = $this->id;
        }
        $d = Category::where('parent_category_id', '=', $idCategory);
        foreach($d->lists('id') as $subId){
            $ids[] = $subId;
            $this->getSubcategoriesIds($ids, $subId);
        }
        return $this;
    }
    
    public function getRecursiveProducts($returnQuery=false) {
        $ids = [];
        $this->getSubcategoriesIds($ids);
       
        $products = Product::whereHas('categories', function($q) use ($ids){
            $q->whereIn('category_id',$ids);
        });
        if($returnQuery){
            return $products;
        }
        return $products->get();
    }
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
        $query = self::whereNull('parent_category_id')->where('type', 0)->where('hidden', 0)->get();
        if($returnQuery){
            return $query;
        }
        return $query;
    }

    public static function getValidateUniqueCategoryURL() {
        return route('category.validateCategory');
    }

    //Esta funcion no se esta ejecutando y se quedo en pruebas
    public static function existsCategory($category) {
        $n = self::where('name', '=', $category)->where('parent_category_id', '=', 17)->count();
        return $n>0;
    }

    public function saveImg($icon) {
        if($icon) {
          $extension = $icon->extension();
            if($icon && ($extension ==='png' || $extension ==='jpeg')) {
                $path = Config('app.paths.categories');
                $icon->move($path, $this->id.'.'. ($extension ==='jpeg'?'jpg': $extension));
            }  
        }  
    }

    public static function getPlayersTennis() {
        $players = self::where('parent_category_id', '!=', NULL)->where('type', 1)->where('hidden', 0)->get();
        return($players);
    }

    public static function getUrlPlayer(){
        $slug = 'self::name';
        return ($slug);
    }

    // </editor-fold>
}