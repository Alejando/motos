<?php

namespace DwSetpoint\Http\Controllers\Api;
use DwSetpoint\Models\Order; 
use Illuminate\Support\Facades\Input;
class OrderController extends \DevTics\LaravelHelpers\Rest\ApiRestController {
    protected static $model = \DwSetpoint\Models\Order::class;
    
    public function getDetails() {
        $order_id = Input::get('order_id'); // ? Input::get('order_id') : 2;
        $order = \DwSetpoint\Models\Order::getById($order_id);
        $items = \DwSetpoint\Models\Order::getById($order_id)->items;
        foreach ($items as $item){ 
            $item->product;
        }
        $order->items = $items;
        // $item = \DwSetpoint\Models\Item::getById(7)->product->name;
        return $order;
    }
    
    public function update(\Illuminate\Http\Request $request, $id) {
        abort(404);
    }
    public function setBillNumber($order) {
        $objOrder = Order::getById($order);        
        $objOrder->bill_number = Input::get('bill_number');
        $objOrder->save();
        return ['success' => true];
    }

    public function cancel ($order) {
        $objOrder = Order::getById($order);        
        $objOrder->cancel();
        return [
            'success' => true, 
            'status' => $objOrder->status
        ];
    }
    public function send($order) {
        $guia = Input::get('guia');
        $url = Input::get('url');
        $objOrder = Order::getById($order);        
        $objOrder->send($guia, $url);
        return ['success' => true];
    }
}
