<?php

namespace DwSetpoint\Models;
use \DwSetpoint\Models\DBConfig as dbconfig;
use Illuminate\Database\Eloquent\Model;

class Address extends \DevTics\LaravelHelpers\Model\ModelBase {
    // <editor-fold defaultstate="collapsed" desc="+ country(): Country ">
    public function country() {
        return $this->belongsTo(\DwSetpoint\Models\Country::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ state(): State">
    public function state() {
        return $this->belongsTo(\DwSetpoint\Models\State::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ user(): User">
    public function user() {
        return $this->belongsTo(\DwSetpoint\Models\User::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ getFullName() : string">
    public function getFullName() {
        return $this->first_name." ".$this->last_name;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: getShippingPrice($address_id, $amount) : int">
    public static function getShippingPrice($address_id, $amount) {
        $address = Address::getById($address_id);        
        $amount4Free = (double)dbconfig::getAmountForShppingFree();
        if($amount >= $amount4Free) {
            return 0;
        }
        $pc = \DwSetpoint\Models\PostalCode::getByCode($address->postal_code);
        if($pc && ($group = $pc->postal_code_group)) {
            if($amount >= (double)$group->amount_free) {
                return 0;
            }
            return (double)$group->price;
        }
        return dbconfig::getDefaultPrice();
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+:: getShippingRules($address_id) : []">
    public static function getShippingRules($address_id) {
        $address = Address::getById($address_id); 
        $amount4Free = (double)dbconfig::getAmountForShppingFree();
        $pc = \DwSetpoint\Models\PostalCode::getByCode($address->postal_code);
        if($pc && ($group = $pc->postal_code_group)) {
            return [
                'ads'=>1,
                'amountForFree' => (double)$group->amount_free,
                'price' => (double)$group->price,               
            ];
        }
        return [
            'amountForFree' => $amount4Free,
            'price' => (double)dbconfig::getDefaultPrice()
        ];
    }
    // </editor-fold>
}
