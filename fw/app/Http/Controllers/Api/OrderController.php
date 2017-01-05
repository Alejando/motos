<?php

namespace DwSetpoint\Http\Controllers\Api;
use DwSetpoint\Models\Order; 
use Illuminate\Support\Facades\Input;
class OrderController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Order::class;
    
    public function getDetails() {
        $order_id = Input::get('order_id'); // ? Input::get('order_id') : 2;
        $items = \DwSetpoint\Models\Order::getById($order_id)->items;
        foreach ($items as $item){ 
            $item->product;
        }
        // $item = \DwSetpoint\Models\Item::getById(7)->product->name;
        return $items;
    }
    
    
}