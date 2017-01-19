<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Models;

/**
 * Description of Coupons
 *
 * @author jdiaz
 */
class Coupon  extends \DevTics\LaravelHelpers\Model\ModelBase{
    const TYPE_PERSENT_BY_AMOUNT = 1;
    const TYPE_DISCOUNT_BY_AMOUNT = 2;
    const TYPE_FREE_PRODUCT_BY_AMOUNT = 3;
       
    public function product() {
        return $this->hasOne(Product::class);
    }
    
    public function stock() {
        return $this->belongsTo(Stock::class);
    }
    
    public function isByPercent() {
        return $this->type== self::TYPE_PERSENT_BY_AMOUNT;
    }
    public function isByDisocuntByAmount(){
        return $this->type == self::TYPE_DISCOUNT_BY_AMOUNT;
    }
    public function isByFreeProduct() {
        return $this->type == self::TYPE_FREE_PRODUCT_BY_AMOUNT;
    }
    public function getDiscount($amount) {
        if($this->isByPercent()) {
            $total = $amount;
            return ($total / 100) * $this->percent;
        } else if($this->isByDisocuntByAmount()){
            return $this->discount;
        } else if($this->isByFreeProduct()){
            return $this->stock->getPrice();            
        }
        return 0;
    }
    public static function getValidateUniqueCodeURL() {
        return route('coupon.validateCode');
    }
    
    public static function existsCode($code) {
        $n = self::where('code', '=', $code)->count();
        return $n>0;
    }
    
    public function getExpireDateTime(){
        return new \DateTime($this->attributes['expire_date']);
    }
    public function getStartDateTime(){
        return new \DateTime($this->attributes['start_date']);
    }
    
    public static function getByCode($code, $returnQuery = false) {
        $query = self::where('code','=',$code);
        if($returnQuery) {
            return $query;
        }
        $coupons = $query->get();
        if($coupons->count()) {
            return $coupons[0];
        }
        return null;
    }
    
    public static function getValdateByCode($code){
        $now = new \DateTime();
        /* @var $coupon Coupon */
        $coupon = self::getByCode($code);   
        if($coupon) {
            $starDate = $coupon->getStartDateTime();
            $expireDate = $coupon->getExpireDateTime();
            if($now >= $starDate && $now <= $expireDate){
                return $coupon;
            } else if($now < $starDate) {
                throw new \Exception("El cupón aun no esta vigente");
            } else if($now > $expireDate) {
                throw new \Exception("El cupón ha expirado");
            }
        }
        throw new \Exception("El cupon no existe");
    
    }
}
