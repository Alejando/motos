<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class PostalCodeGroup extends \DevTics\LaravelHelpers\Model\ModelBase
{
    //
    public function postal_codes()
    {
    	return $this->hasMany(\DwSetpoint\Models\PostalCode::class);
    }
}
