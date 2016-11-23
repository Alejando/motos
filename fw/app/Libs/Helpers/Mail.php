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


}
