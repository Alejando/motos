<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Slider extends \DevTics\LaravelHelpers\Model\ModelBase
{
    public function items() {
        return $this->hasMany(\DwSetpoint\Models\SliderItem::class, 'sliders_id');
    }
}
