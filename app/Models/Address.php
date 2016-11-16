<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Address extends \DevTics\LaravelHelpers\Model\ModelBase
{
    //
    public function country()
    {
    	return $this->belongsTo(\DwSetpoint\Models\Country::class, 'country_id');
    }

    public function state()
    {
    	return $this->belongsTo(\DwSetpoint\Models\State::class, 'state_id');
    }
}
