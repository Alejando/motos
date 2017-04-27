<?php

namespace DwSetpoint\Models;
use Illuminate\Support\Facades\File;
class Product extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = [
        'name',
        'code',
        'slug',
        'brand_id',
        'price_from',
        'description',
        'multi_galeries',
        'discount_percentage',
        'main_banner',
        'default_color_id'
    ];
    public $timestamps = true;    
    // <editor-fold defaultstate="collapsed" desc="brand">
    public function brand() {
        return $this->belongsTo(\DwSetpoint\Models\Brand::class, 'brand_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="defaultColor">
    public function defaultColor() {
        return $this->belongsTo(\DwSetpoint\Models\Product::class, 'default_color_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="categories">
    public function categories() {
        return $this->belongsToMany(\DwSetpoint\Models\Category::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="sizes">
    public function sizes() {
        return $this->belongsToMany(Size::class)->orderBy('id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="colors">
    public function colors() {
        return $this->belongsToMany(Color::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="stocks">
    public function stocks() {
        return $this->hasMany(\DwSetpoint\Models\Stock::class);
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
    public function favorites(){
        $products = \DwSetpoint\Models\Product::where('favorite')->get();
        return $products;
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
    public static function getImgCacheName($slugProduct, $img, $w,$h,$ext) {
        return config('app.paths.img-products-cache')."$slugProduct/$img/v{$w}x{$h}.$ext";
    }
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
    // <editor-fold defaultstate="collapsed" desc="setNameAttribute">
    public function setNameAttribute($name){
        $this->attributes['name'] = $name;
        $this->slug = str_slug($name);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="validateImgName">
    private function validateImgName ($img) {
        $validator = \Illuminate\Support\Facades\Validator::make(
                ['img' => $img],
                ['img' => 'regex:/^[a-z0-9\.\-\ \_]+$/'],
                ['img.regex' => "Nombre de archivo no valido"]);        
        if($validator->fails()){
            throw new \Exception($validator->errors()->all()[0],1001);
        }
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getFileRoute">
    public function getFileRoute($img) {
        return $this->getImgPath() . $img;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="removeImg">
    public function removeImg($img) {
        $this->validateImgName($img);
        $file = $this->getFileRoute($img);
        if(file_exists($file)) {
            unlink($this->getImgPath().$img);
            return true;
        }
        throw new \Exception("El fichero no existe",1002);        
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="editImg">
    public function editImg($img, $newName) {
        $this->validateImgName($img);
        $this->validateImgName($newName);
        $file = $this->getFileRoute($img);
        $newName = $this->getFileRoute($newName);
        if(file_exists($file)) {
            rename($file, $newName);
            return true;
        }
        throw new \Exception("El fichero no existe",1002);        
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="setColorsById">
    public function setSizesByIds($ids) {
        $this->sizes()->sync((array)$ids);
        return $this;
    }
    // </editor-fold>
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
    // <editor-fold defaultstate="collapsed" desc="getImgsAttribute">
    public function getImgsAttribute() {
        $path = $this->getImgPath();
        if(file_exists($path)){
            chdir($path);
            return glob("*{png,jpg,jpeg}", GLOB_BRACE);
        }
        return [];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="hasOrders">
    public function hasOrders() {
        return Item::where('product_id','=', $this->id)->count() > 0;
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="getCover">
    public function getCover(){

    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getURL">
    public function getURL($category = false) {
        return route('product.showDetails', [
            'categorySlug' => $category,
            'productSlug' =>$this->slug
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getURLCover">
    public function getURLCover() {
        if(isset($this->imgs[0]) && File::extension($this->imgs[0])){
            $ext = File::extension($this->imgs[0]);
            return route('product.getCover',[
                'slug'=>$this->slug,
                'ext'=> 'png'
            ]);
        }
        return route('product.getCover',[
            'slug'=>'default',
            'ext'=> 'png'
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="updatePathUpload">
    public function updatePathUpload($oldCode) {        
        $newPath = $this->getImgPath();        
        $filename = config("app.paths.products") . $oldCode;
        if(file_exists($filename)){
            rename($filename, $newPath);
            chmod($newPath, config('app.permissionFiles'));
        } else {
            $this->makeImgPath();
        }
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="removePath">
    public function removePath(){
        $dirname = $this->getImgPath();
        if(file_exists($dirname)){
            array_map('unlink', glob("$dirname/*.*"));
            rmdir($dirname);
        }
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="image">
    public function image($image, $width, $height) {
        $path = $this->getImgPath().$image;
        if(file_exists($path)){
            return \DevTics\LaravelHelpers\Utils\Image::toFit($path,
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
    // </editor-fold>
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
    // <editor-fold defaultstate="collapsed" desc="getDiscountPercentageAttribute">
    public function getDiscountPercentageAttribute() {
        return $this->attributes['discount_percentage'];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getClculateDiscount">
    public function getClculateDiscount() {
       return $this->priceFrom * ($this->discountPercentage / 100);
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="checkStock">
    public function checkStock($quantity, $size, $color) {
        /* @var $query \Illuminate\Database\Query\Builder */
        $query = Stock::where('product_id', '=' , $this->id);
        if($size===null) {
            $query->whereNull('size_id');
        } else {
            $query->where('size_id', '=', $size);
        }
        if($color===null) {
            $query->whereNull('color_id');
        } else {
            $query->where('color_id', '=', $color);
        }
        $stocks = $query->get();
        if($stocks->count()) {
            $stock = $stocks->get(0);
            if($quantity<=$stock->quantity){
                return $stock;
            }
            throw new \Exception("Lo sentimos actualmente solo contamos con ".$stock->quantity." artículos en existencia");
        }
        throw new \Exception("Lo sentimos actualmente no tenemos esa talla en el color seleccionado");
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="hasDiscount">
    public function hasDiscount() {
        return (float) $this->discountPercentage > 0;
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="getBySlug">
    public static function getBySlug($slug, $returQuery = false) {
        $query = self::where('slug', '=', $slug);
        if($returQuery){
            return $query;
        }
        return $query->get()->get(0);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getValidateUniqueCodeURL">
    public static function getValidateUniqueCodeURL() {
        return route('product.validateCode');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getValidateUniqueSlugURL">
    public static function getValidateUniqueSlugURL($edit=false) {
        return route('product.validateSlug', [ 
            'edit' => $edit 
        ]);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="existsCode">
    public static function existsCode($code) {
        $n = self::where('code', '=', $code)->count();
        return $n>0;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="existsSlug">
    public static function existsSlug($slug) {
        $n = self::where('slug', '=', $slug)->count();
        return $n>0;
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="getMainProducts">
    public static function getMainProducts() {
        $mainProducts = self::where('main_banner', 1)->get();
        return($mainProducts);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getRandomProducts">
    public static function getRandomProducts($id) {
        $nProducts = self::where('id', '!=', $id)->lists("id")->count();  
        if($nProducts==0) {
            return false;
        }else if($nProducts <= 4){
            return self::getRandom($nProducts);
        }else{
            $randomProducts = self::getRandom(4);
            return $randomProducts ; 
        }
    }
    // </editor-fold>
}