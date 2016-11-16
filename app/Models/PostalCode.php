<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends \DevTics\LaravelHelpers\Model\ModelBase
{
    //
    public function postal_code_group()
    {
    	return $this->belongsTo(\DwSetpoint\Models\PostalCodeGroup::class, 'postal_code_group_id');
    }
}
