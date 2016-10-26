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
            $args['to'] = [];
            $args['rawPassword'] = str_random(8); 
        }
        $args['subject'] = '¡Bienvenido a GlimGlam!';
        return self::sendMail('welcome', $args, $test, $send, $format);
    }
    // </editor-fold>    
    // <editor-fold defaultstate="collapsed" desc="resetPassword">
    public static function resetPassword($args = [], $test = false, $send = true, $format = 'html') {
        $args['subject'] = "Recupearación de Password";
        return self::sendMail('reset-password', $args, $test, $send, $format);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="enrollment">
    public static function enrollment($args = [], $test = false, $send = true, $format = 'html') {
        $args['user'] = \DwSetpoint\Models\User::getRandom();
        return self::sendMail('confirm-enrollment', $args, $test, $send, $format);
    }
    // </editor-fold>
    public static function otroCorreo($args, $test = false,$send = true, $format = 'html') {
        return self::sendMail('otro-correo', $args, $test, $send, $format);
    }
}