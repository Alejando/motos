<?php

namespace DwSetpoint\Models;
class Brand  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name'];
    // <editor-fold defaultstate="collapsed" desc="+ products(): hasMany<Product>">
    public function products() {
        return $this->hasMany(\DwSetpoint\Models\Product::class, 'product_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ getImgURL(int $width, int $height): String">
    public function getImgURL($width, $height) {
        return route('brand.getLogo',[
            'id'=> $this->id,
            'slugSEO'=> str_slug($this->name).'_',
            'width' => $width,
            'height' => $height
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ saveImg($icon): null">
    public function saveImg($icon) {
        if($icon) {
          $extension = $icon->extension();
            if($icon && ($extension ==='png' || $extension ==='jpeg')) {
                $path = Config('app.paths.brads');
                $icon->move($path, $this->id.'.'. ($extension ==='jpeg'?'jpg': $extension));
            }  
        }  
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: getValidateUniqueBrandURL(): String">
    public static function getValidateUniqueBrandURL() {
        return route('brand.validateBrand');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: existsBrand($brand): bool">
    public static function existsBrand($brand) {
        $n = self::where('name', '=', $brand)->count();
        return $n>0;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: getBrands(): Collection<Brand>">
    public static function getBrands() {
        $brands = self::all();
        return($brands);
    }
    // </editor-fold>
}