<?php
namespace DwSetpoint\Libs\Helpers;
use \Mail as SendEmail;
class HelperMail {
    public function embed($pathToFile) {
        return asset($pathToFile);
    }
    public function embedData(){        
        
    }
}

class Mail{
    // <editor-fold defaultstate="collapsed" desc="sendMail">
    public static function sendMail($view, $args, $test=false, $send = true, $format='html') {
        $txtView = 'mails.txt.'.$view;
        $htmlView = 'mails.html.'.$view;
        $strMsjTxt =  view($txtView, $args);
        if($send == true) {
            SendEmail::send([
                    'mails.frames.html', 
                    'mails.frames.txt'
                ], [
                    'txt' => $strMsjTxt
                ], 
                function (\Illuminate\Mail\Message $message) use ($args, $htmlView, $test) {
                    $args['message'] = $message;
                    $body = view($htmlView, $args);
                    $message->getSwiftMessage()->setBody((new \Pelago\Emogrifier($body))-> emogrify());
                    $message->from([env('EMAIL_APP') => env('EMAIL_SENDERNAME')]);
                    $to = (array)$args['to'];
                    if($test) { 
                      $to[] = env('EMAIL_TEST_DEVELOPER');
                    }
                    $message->subject(isset($args['subject'])?$args['subject']:'No Subject');
                    $message->to($to);
                 }
            );
        }
        
        if($test) {
            $args['message'] = new HelperMail;
            if($format === 'html') {
                $bodyHTMLTest =  view($htmlView, $args);
                return $bodyHTMLTest;
            }else{
                return $strMsjTxt;
            }
        }
        return true;
    }
    // </editor-fold>
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
    // <editor-fold defaultstate="collapsed" desc="auctionPayment">
    public static function auctionPayment($args = [], $test = false, $send = true, $format = 'html') {
//        $args['auction'] = isset($args['auction']) ? $args['auction'] : \GlimGlam\Models\Auction::getRandom();
//        $args['payment'] = isset($args['payment']) ? $args['payment']: \GlimGlam\Models\Payment::getRandom();
        $args['subject'] = "Confirmación de pago, {$args['auction']->title} [FOLIO: {$args['payment']->folio}]";
        $args['to'] = isset($args['to']) ? $args['to'] : $args['user']->email;
        return self::sendMail('auction-payment', $args, $test, $send, $format);
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
    // <editor-fold defaultstate="collapsed" desc="recordatory">
    public static function recordatory($args = [], $test = false, $send = true, $format = 'html') {
        $args['subject'] = "Recordatorio de subasta";
        $args['auction'] = \DwSetpoint\Models\Auction::getRandom();
        return self::sendMail('auction-recordatory', $args, $test, $send, $format);
    }
    // </editor-fold>
}