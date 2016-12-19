<?php

namespace DwSetpoint\Models;
class Brand  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name'];
    public function products() {
        return $this->hasMany(\DwSetpoint\Models\Product::class, 'product_id');
    }
    public function getImgURL($width, $height) {
        return route('brand.getLogo',[
            'id'=> $this->id,
            'slugSEO'=> str_slug($this->name).'_',
            'width' => $width,
            'height' => $height
        ]);
    }
    public function saveImg($icon) {
        if($icon) {
          $extension = $icon->extension();
            if($icon && ($extension ==='png' || $extension ==='jpeg')) {
                $path = Config('app.paths.brads');
                $icon->move($path, $this->id.'.'. ($extension ==='jpeg'?'jpg': $extension));
            }  
        }
        
    }
    public static function getValidateUniqueBrandURL() {
        return route('brand.validateBrand');
    }

    public static function existsBrand($brand) {
        $n = self::where('name', '=', $brand)->count();
        return $n>0;
    }
    
}