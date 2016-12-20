<?php

namespace DwSetpoint\Models;
class BillingInformation  extends \DevTics\LaravelHelpers\Model\ModelBase {
    
    protected $table = 'billing_information';
    
    public function user() {
        return $this->belongsTo(\DwSetpoint\Models\User::class);
    }
    
    public function country() {
        return $this->belongsTo(\DwSetpoint\Models\Country::class, 'country_id');
    }

    public function state() {
        return $this->belongsTo(\DwSetpoint\Models\State::class, 'state_id');
    }
}