<?php
namespace GlimGlam\Models;

class Category extends \GlimGlam\Libs\CoreUtils\ModelBase{
//    public $timestamps = true;
    public function parentCategory() {
        return $this->belongsTo(Category::class, 'parentCategory');
    }
    
    public function subCategories(){
       return $this->hasMany(Category::class, 'parentCategory');
    }
    public static function getRandomParentCategory() {
       return self::whereNull('parentCategory')->orderBy(\DB::raw('RAND()'))->limit(1)->get()->get(0);
    }
}