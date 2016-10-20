<?php

namespace DwSetpoint\Models;
class Category  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name','parent_category_id'];
    public function products() {
        return $this->hasMany(\DwSetpoint\Models\Product::class, 'product_id');
    }
    
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_category_id');
    }
    
    public function subcategories(){
        return $this->hasMany(Category::class,'parent_category_id');
    }
    
    public function getPath() {
        return "ok/ok/ok";
    }

    public static function getRoots($returnQuery = false) {
        $query = self::whereNull('parent_category_id')->get();
        if($returnQuery){
            return $query;
        }
        return $query;
    }
    
}