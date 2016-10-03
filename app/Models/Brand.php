<?php

namespace DwSetpoint\Models;
class Brand  extends \DevTics\LaravelHelpers\Model\ModelBase {
    protected $fillable = ['name'];
    public function products() {
        return $this->hasMany(\DwSetpoint\Models\Product::class, 'product_id');
    }
    public function saveImg($icon) {
        $extension = $icon->extension();
        if($icon && ($extension ==='png' || $extension ==='jpeg')) {
            $path = Config('app.paths.brads');
            $icon->move($path, $this->id.'.'. ($extension ==='jpeg'?'jpg': $extension));
        }
    }
    
}