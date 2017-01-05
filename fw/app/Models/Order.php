<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends \DevTics\LaravelHelpers\Model\ModelBase {
    const STATUS_PAYMED = 1;
    const STATUS_STAN_BY = 2;
    const STATUS_CANCEL = 3;
    
    const PSP_PAYPAL = 1;
    const PSP_CONEKTA = 2;
    
    public $timestamps = true;
    
    public function items() {
        return $this->hasMany(\DwSetpoint\Models\Item::class);
    }
    public function sendMail($user) {
        \DwSetpoint\Libs\Helpers\Mail::order([
            'user' => $user,
            'order' => $this
        ]);
        return $this;
    }
    public function getDateTiemeCreateAt($strTimeZone = 'America/Mexico_City') {
        $timeZone = new \DateTimeZone($strTimeZone);
        $objDate = new \DateTime($this->attributes['created_at']);
        $objDate->setTimezone($timeZone);
        return $objDate;
    }
    public function coupon() {
        return $this->belongsTo(\DwSetpoint\Models\Coupon::class);
    }
     public function address() {
        return $this->belongsTo(\DwSetpoint\Models\Address::class);
    }
    public function user() {
        return $this->belongsTo(\DwSetpoint\Models\User::class);
    }
    public function getAmount() {
        return 100;
    }
    public function getAmountCoupon() {
        return 100;
    }
    public function getTotal() {
        return $this->getSubTotal();
    }
    public function getSubTotal() {
        $total = 0;
       foreach($this->items as  $orderItem){
            $total += (double)$orderItem->getPrice() * (double)$orderItem->quantity;
        }
        return $total;
    }
    
    public function requestBill() {
        return false;
    }
    public function getShipping() {
        return 100;
    }
    public function getTotalWhitShpping() {
        return $this->gettotal() + $this->getShipping();
    }
}
