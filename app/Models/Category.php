<?php
namespace GlimGlam\Models;
/**
 * @property string $name Nombre de la categoria
 * @property int|null $parentCategory Categoria padre
 */
class Category extends \GlimGlam\Libs\CoreUtils\ModelBase{
    
    public function parentCategory() {
        return $this->belongsTo(Category::class, 'parentCategory');
    }
    
    public function subCategories(){
       return $this->hasMany(Category::class, 'parentCategory');
    }
    
    public static function getRandomParentCategory() {
       return self::whereNull('parentCategory')->orderBy(\DB::raw('RAND()'))->limit(1)->get()->get(0);
    }
    
    public static function getByName ($name) {
        return self::where('name','=', $name)->get()->get(0);
    }
}