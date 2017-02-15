<?php

namespace DwSetpoint\Models;
use Illuminate\Database\Eloquent\Model;
class Item extends \DevTics\LaravelHelpers\Model\ModelBase {
    // <editor-fold defaultstate="collapsed" desc="+ product(): belogsTo<Product>">
    public function product() {    
        return $this->belongsTo(\DwSetpoint\Models\Product::class);    
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ order(): belogsTo<Order>">
    public function order() {    
        return $this->belongsTo(\DwSetpoint\Models\Order::class);    
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ stock(): BelogsTo<Stock>">
    public function stock() {
        return $this->belongsTo(\DwSetpoint\Models\Stock::class);    
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ getPrice(): integer">
    public function getPrice() {
        $product = $this->product;
        if($product->discount_percentage) {//hay descuento por producto
            $price = $this->price;
        }else {
            $price = $this->price;
        }
        return $price;
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="+ deliverStock(): bolean">
    public function deliverStock() {
        $this->stock->quantity -= $this->quantity;
        $this->stock->save();
        return true;
    }
    // </editor-fold>
}