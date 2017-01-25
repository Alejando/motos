<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers;

use Illuminate\Support\Facades\Input;
use DwSetpoint\Models\Stock;
use DwSetpoint\Models\Item;
use \DwSetpoint\Models\PSP; 
use\DwSetpoint\Models\Order;
/**
 * Description of CartController
 *
 * @author jdiaz
 */
class ConektaController  extends Controller {
    
    public function getOxxoFormat($order, $format) {
        $objOrder = \DwSetpoint\Models\Order::getById($order);
        
        $objOrder->sendFormatOxxo();
        if($format=='pdf') {
            $pdf = $objOrder->getPDFOxxo();           
            if(Input::get('download')!==null) {
                return $pdf->download();
            }
            return $pdf->stream();
        }
        return $objOrder->getViewOxxo();
    }
    
    public function oxxoConfirm($order) {
        $objOrder = \DwSetpoint\Models\Order::getById($order);
        if(auth()->user() == $objOrder->user) {
            return view('public.pages.cart.success-conekta-oxxo', [
                'order' => $objOrder
            ]);
        }
        abort(404);
    }
    public function webhook(){
        $response_json = @file_get_contents('php://input');
        $response = json_decode($response_json);
        $chargeId = $response->data->object->id;
        $webhook = \DwSetpoint\Models\ConektaWebhook::getByIdCharge($chargeId);
        if($response->type=='charge.paid'){
            $webhook->processed = true;
            $webhook->order->setPaid();
            $webhook->save();
        }
        \DwSetpoint\Models\ConektaWebhookEvent::create([
            'event_id' => $response->id,
            'response_info' => $response_json,
            'order_id' => $webhook->order->id,
            'charge_id' => $chargeId
        ]);
        file_put_contents("upload/webhook/test.txt", $response_json);
    }
}
