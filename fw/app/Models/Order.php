<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;

class Order extends \DevTics\LaravelHelpers\Model\ModelBase {
    const STATUS_PAYMED = 1;
    const STATUS_STAN_BY = 0;
    const STATUS_CANCEL = 3;
   
    const PSP_PAYPAL = 1;
    const PSP_TC_CONEKTA = 2;
    protected $dateFormat = 'Y-m-d H:i:s';
    public $dates = ['created_at','end_date'];
    public $timestamps = true;
    public static $IVA = false;
    public function getCreatedAtAttribute() {
        return $this->datetimeFormat('created_at');
    }
    public function deliverStock() {
        $items = $this->items;
        foreach ($items as $item){
            $item->deliverStock();
        }
        return $this;
    }
    public function send($guia, $url) {
        $this->urlguia = $url;
        $this->guia = $guia;
        $this->sent = true;
        $this->save();
        \DwSetpoint\Libs\Helpers\Mail::shipping([
            'user' => $this->user,
            'order' => $this
        ]);
        return $this;
    }
    public static function getAllForDataTables() {
        return self::orderBy('created_at','DESC')->get();
    }
    
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
    public function billing_information() {
        return $this->belongsTo(\DwSetpoint\Models\BillingInformation::class);
    }
    
    public function getAmount() {
        return 100;
    }
    public function getAmountCoupon() {        
        if($this->hasCoupon()) {
            return $this->coupon->getDiscount($this->getSubTotal());
        } 
        return 0;
    }
    public function getTotal() {
        return $this->getSubTotal() - $this->getAmountCoupon() + $this->getShipping();
    }
    public function hasCoupon() {
        return !!$this->coupon_id;
    }
    public function getSubTotal() {
        $total = 0;
       foreach($this->items as  $orderItem){
            $total += (double)$orderItem->getPrice() * (double)$orderItem->quantity;
        }
        return $total;
    }
    
    public function requestBill() {
        return !!$this->billing_information_id;
    }
    public function getTaxs() {
        $iva = DBConfig::getIVA();
        $subTotal = (double)$this->getSubTotal() - (double)$this->getAmountCoupon();
        return ($subTotal/100) * $iva;
    }
    
    public function getApportion($amount) {
        $iva = self::$IVA;
        if($this->requestBill()) {
            return $amount / (1 + ($iva / 100));
        }
        return $amount;
    }
    
    public function getShipping() {
        $shipping = Address::getShippingPrice($this->address_id, $this->getSubTotal());
        return $shipping;
    }
}
if(Order::$IVA===false) {
    Order::$IVA = DBConfig::getIVA();
}