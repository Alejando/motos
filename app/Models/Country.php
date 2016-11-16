<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Country  extends \DevTics\LaravelHelpers\Model\ModelBase
{
	public function states(){
		return $this->hasMany(\DwSetpoint\Models\State::class);
	}

	public function addresses()
	{
		return $this->hasMany(\DwSetpoint\Models\Address::class);
	}

}
