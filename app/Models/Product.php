<?php

namespace DwSetpoint\Models;
class Product extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = [
        'name',
        'code',
        'slug',
        'brand_id',
        'price_from',
        'description',
        'multi_galeries',
        'discount_percentage'
    ];
    // <editor-fold defaultstate="collapsed" desc="brand">
    public function brand() {
        return $this->belongsTo(\DwSetpoint\Models\Brand::class, 'brand_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="categories">
    public function categories() {
        return $this->belongsToMany(\DwSetpoint\Models\Category::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="sizes">
    public function sizes() {
        return $this->belongsToMany(Size::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="colors">
    public function colors() {
        return $this->belongsToMany(Color::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="stocks">
    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class, 'stock_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="saveUploadImgs">
    public function saveUploadImgs($imgs) {
        if(is_array($imgs) || ($imgs instanceof Traversable)) {
            foreach($imgs as $img){
                $this->saveUploadImg($img);
            }
        }
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="saveUploadImg">
    public function saveUploadImg(\Illuminate\Http\UploadedFile $img) {
        $ext = $img->extension();
        $this->makeImgPath();
        if($ext=='jpeg' || $ext =='png'){
            $orgExt = $img->getClientOriginalExtension();
            $file = $this->getImgPath().$img->getClientOriginalName();
            if(file_exists($file)){
                $name = str_replace(".$orgExt", "_".time().'.'.$orgExt, $img->getClientOriginalName());
                $img->move($this->getImgPath(),  $name);
            }else{
                $name = $img->getClientOriginalName();
                $img->move($this->getImgPath(),$name);
            }
//            dd($name);
            chmod($this->getImgPath().$name, config('app.permissionFiles'));
        }
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getImgPath">
    public function getImgPath() {
        return config("app.paths.products") . "{$this->code}/";
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="makeImgPath">
    public function makeImgPath() {
        $filename = config("app.paths.products") . $this->code;
        if(!file_exists($filename)) {
            mkdir($filename);
            chmod($filename, config('app.permissionFiles'));
        }
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setColorsById">
    public function setSizesByIds($ids) {
        $this->sizes()->sync((array)$ids);
        return $this;
    }
    // <editor-fold defaultstate="collapsed" desc="setColorsById">
    public function setColorsByIds($ids) {
        $this->colors()->sync((array)$ids);
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setCategoriesById">
    public function setCategoriesByIds($ids) {
        $this->categories()->sync($ids);
        return $this;
    }
    // </editor-fold>
    public function getImgsAttribute() {
        $path = $this->getImgPath();
        if(file_exists($path)){
            chdir($path);
            return glob("*{png,jpg,jpeg}", GLOB_BRACE);
        }
        return [];
    }
    public function getCover(){

    }
    public function getURL($category = false) {
        return route('product.showDetails', [
            'categorySlug' => $category,
            'productSlug' => str_slug($this->name)
        ]);
    }
    public function getURLCover() {
        return route('product.getCover',[
            'id'=>$this->id
        ]);
    }
    public function updatePathUpload($oldCode) {
        $newPath = $this->getImgPath();
        $filename = config("app.paths.products") . $oldCode;
        rename($filename, $newPath);
        chmod($newPath, config('app.permissionFiles'));
        return $this;
    }
    public function removePath(){
        $dirname = $this->getImgPath();
        if(file_exists($dirname)){
            array_map('unlink', glob("$dirname/*.*"));
            rmdir($dirname);
        }
        return $this;
    }
    public function image($image, $width, $height) {
        $path = $this->getImgPath().$image;
        if(file_exists($path)){
            return \DwSetpoint\Libs\Helpers\Image::toFit($path,
                $width,
                $height,
                'png',
                config('app.config-images.fillcolor'),
                config('app.config-images.fillopacity'),
                true
            );
        }
        return false;
    }
    // <editor-fold defaultstate="collapsed" desc="getSerialNumberAttribute">
    public function getSerialNumberAttribute() {
        return $this->attributes['serial_number'];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getPriceFromAttribute">
    public function getPriceFromAttribute() {
        return $this->attributes['price_from'];
    }
    // </editor-fold>
    public function getDiscountPercentageAttribute() {
        return $this->attributes['discount_percentage'];
    }
    public function getClculateDiscount() {
       return $this->priceFrom * ($this->discountPercentage/100); 
    }
    public function hasDiscount() {
        return (float) $this->discountPercentage > 0;
    }
    // <editor-fold defaultstate="collapsed" desc="getBySlug">
    public static function getBySlug($slug, $returQuery = false) {
        $query = self::where('slug', '=', $slug);
        if($returQuery){
            return $query;
        }
        return $query->get()->get(0);
    }
    // </editor-fold>

}
