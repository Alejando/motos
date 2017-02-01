<?php
namespace DwSetpoint\Libs\Helpers;

class HelperMail {
    public function embed($pathToFile) {
        return asset($pathToFile);
    }
    public function embedData(){        
        
    }
}

class Mail extends MailBase {
    // <editor-fold defaultstate="collapsed" desc="welcome">
    public static function welcome($args, $test = false, $send = true, $format = 'html') {
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            //$args['to'] = [];
            $args['rawPassword'] = str_random(8); 
        }else {
            $args['to'] = $args['user']->email; 
        }
        $args['subject'] = '¡Bienvenido a Bounce - Tennis Lifestyle!';
        return self::sendMail('welcome', $args, $test, $send, $format);
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="resetPassword">
    public static function resetPassword($args = [], $test = false, $send = true, $format = 'html') {
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            //$args['to'] = [];
            $args['rawPassword'] = str_random(8); 
        }
        $args['subject'] = "Recupearación de Password";
        return self::sendMail('reset-password', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="confirmPayment">
    public static function confirmPayment($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $args['to'] = [];
            $args['rawPassword'] = str_random(8); 
        }
        /*
        if(!isset($args['payment'])) {
            $payment = \DwSetpoint\Models\Payment::getRandom(); 
            $args['payment'] = $payment;
        }
         */
        $args['subject'] = "Confirmación de pago";
        return self::sendMail('confirm-payment', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="tracePayment">
    public static function tracePayment($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $args['to'] = [];
        }
        /*
        if(!isset($args['payment'])) {
            $payment = \DwSetpoint\Models\Payment::getRandom(); 
            $args['payment'] = $payment;
        }
         */
        $args['subject'] = "Seguimiento de pedido";
        return self::sendMail('trace-payment', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="contact">
    public static function contact($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $args['to'] = [];
        }
        $args['subject'] = "Contacto Bounce";
        return self::sendMail('contact', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="order">
    public static function order($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $inputOrder = \Illuminate\Support\Facades\Input::get('order');
            $args['order'] = $inputOrder ? \DwSetpoint\Models\Order::getById($inputOrder) : \DwSetpoint\Models\Order::getRandom();
        }
        $args['to'] = $args['user']->email;
        $args['subject'] = "Confirmación de pedido " . $args['order']->id;
        $args['fnPrepare'] =  function (\Illuminate\Mail\Message $message) {
            $message->bcc(\DwSetpoint\Models\DBConfig::getOrderEmail());
        };
        return self::sendMail('order', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="shipping">
    public static function shipping($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $inputOrder = \Illuminate\Support\Facades\Input::get('order');
            $args['order'] = $inputOrder ? \DwSetpoint\Models\Order::getById($inputOrder) : \DwSetpoint\Models\Order::getRandom();
        }
        $args['to'] = $args['user']->email;
        $args['subject'] = "Confirmación de envió de pedido";
        return self::sendMail('shipping', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="formatOxxo">
    public static function formatOxxo($args = [], $test = false, $send = true, $format = 'html'){
        if(!isset($args['user'])) {
            $user = \DwSetpoint\Models\User::getRandom(); 
            $args['user'] = $user;
            $inputOrder = \Illuminate\Support\Facades\Input::get('order');
            $args['order'] = $inputOrder ? \DwSetpoint\Models\Order::getById($inputOrder) : \DwSetpoint\Models\Order::getRandom();
        }
        $args['to'] = $args['user']->email;
//        $args['to'] = 'wariodiaz@gmail.com';
        $order = $args['order'];
        $args['subject'] = "Formato de pago en tiendas OXXO del pedido {$order->id}";        
        $pdf = $order->getPDFOxxo();
        $args['files-stream'] = [
            [
                'stream'=> $pdf->stream()->content(),
                'name' => "pago-oxo-".$order->id.'.pdf'
            ]
        ];
        $args['fnPrepare'] =  function (\Illuminate\Mail\Message $message) {
            $message->bcc(\DwSetpoint\Models\DBConfig::getOrderEmail());
        };
        return self::sendMail('format-oxxo', $args, $test, $send, $format);
    }
    // </editor-fold>
}
