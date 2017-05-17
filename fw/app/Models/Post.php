<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Post extends \DevTics\LaravelHelpers\Model\ModelBase
{
  public function category() {
      return $this->belongsTo(\DwSetpoint\Models\PostCategory::class,'post_category_id');
  }
}
