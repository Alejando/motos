<?php

namespace DwSetpoint\Models;
class BillingInformation  extends \DevTics\LaravelHelpers\Model\ModelBase {    
    protected $table = 'billing_information';
    // <editor-fold defaultstate="collapsed" desc="+ user(): BelongsTo<User>">
    public function user() {
        return $this->belongsTo(\DwSetpoint\Models\User::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ country(): BelogsTo<Country>">
    public function country() {
        return $this->belongsTo(\DwSetpoint\Models\Country::class, 'country_id');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ state(): BelogsTo <State>">
    public function state() {
        return $this->belongsTo(\DwSetpoint\Models\State::class, 'state_id');
    }
    // </editor-fold>
}