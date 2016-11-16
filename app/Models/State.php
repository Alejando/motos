<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class State extends \DevTics\LaravelHelpers\Model\ModelBase
{
    //
    public function country()
    {
    	return $this->belongsTo(\DwSetpoint\Models\Country::class, 'country_id');
    }

    public function addresses()
	{
		return $this->hasMany(\DwSetpoint\Models\Address::class);
	}
}
