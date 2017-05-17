<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends \DevTics\LaravelHelpers\Model\ModelBase
{
  public function category() {
      return $this->hasMany(\DwSetpoint\Models\Post::class);
  }
}
