<?php

namespace DwSetpoint\Models;
class Product extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = [
        'name', 
        'description', 
        'code',
        'brand_id',
        'multi_galeries'
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
    public function setColorsByIds($ids) {
        $this->colors()->sync((array)$ids);
        return $this;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setCategoriesById">
    public function setCategoriesByIds($ids) {
        $this->categories()->sync($ids);
    }
    // </editor-fold>

}