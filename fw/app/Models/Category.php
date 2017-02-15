<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name','parent_category_id', 'type', 'hidden','slug'];
    // <editor-fold defaultstate="collapsed" desc="+:: validate($data, $id = false):bolean">
    public static function validate($data, $id = false) {
        if($id) {
            $category = self::getById($id);
            $existSlug = self::existsSlug($data['slug'], $category->parent_category_id, $category->id);            
        } else {
            $existSlug = self::existsSlug(
                $data['slug'], 
                false, 
                isset($data['parent_category_id']) ? $data['parent_category_id'] : false
            );
        }
        if($existSlug) {
            throw new \Exception("El slug \"".$data['slug']. "\" ya existe", 401);
        }
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: existsSlug($slug, $parent_id = false, $category_id = false):boolean">
    public static function existsSlug($slug, $parent_id = false, $category_id = false) {
        $query = self::where('slug', '=' ,$slug);
        if($parent_id) {
            $query->where('parent_category_id', '=', $parent_id);
        } else {
            $query->whereNull('parent_category_id');
        }
        if($category_id){
            $query->where('id', '!=', $category_id);
        }
        $res = $query->count();
        return $res>0;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: findChildrenBySlug(Category|null $parent, string $categorySlug): Category|null <deprecated>">
    public static function findChildrenBySlug($parent, $categorySlug) {
        $query = \DwSetpoint\Models\Category::where('slug', '=', $categorySlug);
        if($parent!==null){
            $query->where('parent_category_id','=', $parent->id);
        } else {
            $query->whereNull('parent_category_id');
        }
        $category = $query->get();
        if($category->count()) {
            return $category->get(0);
        } 
        return null;
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="fixSlug">
    public static function fixSlug($slug){
//        $slugs = [
//            'squash-fronton' => 'Squash + Fronton',
//            'faldasshorts' => 'Faldas/Shorts'
//        ];
//        if(isset($slugs[$slug])) {
//            return $slugs[$slug];
//        }
        return $slug;
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="getBySlug">
    public static function getBySlug($slug) {
        $expoSlug = explode("/", $slug);
        $category = null;
        foreach($expoSlug as $categoryslug) {
            $categoryslug = self::fixSlug($categoryslug);
            $r = self::findChildrenBySlug($category,$categoryslug);
            $category = $r; 
        }
//        dd($category->toArray()  );
        return $category;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="products">
    public function products() {
        return $this->belongsToMany(\DwSetpoint\Models\Product::class)->orderBy('id', 'desc');
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
    // <editor-fold defaultstate="collapsed" desc="hasSubcategories">
    public function hasSubcategories() {
        return self::where('parent_category_id','=', $this->id)->count() > 0;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getSubcategoriesIds">
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
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRecursiveProducts">
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
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="getParents">
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
        $parents[] =  $this->slug;
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
