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
use Illuminate\Support\Facades\Mail;
/**
 * Description of CartController
 *
 * @author jdiaz
 */
class ConektaController  extends Controller {
    
    public function getOxxoFormat($order, $format) {
        $objOrder = \DwSetpoint\Models\Order::getById($order);
        if(auth()->user() == $objOrder->user){
            if($format=='pdf') {
                $pdf = $objOrder->getPDFOxxo();           
                if(Input::get('download')!==null) {
                    return $pdf->download('bounce-orden-'.$objOrder->id.'.pdf');
                }
                return $pdf->stream();
            }
            return $objOrder->getViewOxxo();
        }
        abort(404);
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
        try{
            $response_json = @file_get_contents('php://input');
            $response = json_decode($response_json);
            $chargeId = $response->data->object->id;
            $webhook = \DwSetpoint\Models\ConektaWebhook::getByIdCharge($chargeId);
            if($webhook) {
                if($response->type=='charge.paid'){
                    $webhook->processed = true;
                    $webhook->order->setPaid();
                    $webhook->save();
                }
                \DwSetpoint\Models\ConektaWebhookEvent::create([
                    'event_id' => $response->id,
                    'response_info' => $response_json,
                    'order_id' => $webhook->order->id,
                    'charge_id' => $chargeId,
                    'type' => $response->type
                ]);
            }else {
                throw new \Exception("No se encontro el webhook");
            }
        }catch(\Exception $ex){
            Mail::raw(json_encode($response,JSON_PRETTY_PRINT)."\n\n\n".$ex->getMessage()."\n\n".$ex->getTraceAsString(), function($m){
                $m->getSwiftMessage()->setContentType('text/plain');
                $m->to(env('EMAIL_DEVELOER'));
                $m->subject('fail en webhook conekta bounce ['. (\Carbon\Carbon::now("America/Mexico_City")->toDateTimeString()).']');
            });
        }
        
//        file_put_contents("upload/webhook/test.txt", $response_json);
    }
}
