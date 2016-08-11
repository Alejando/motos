<?php
namespace GlimGlam\Libs\Helpers;
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
        if($test == false || $send = true) {
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
                    $message->from('jdiaz@estrasol.com.mx');
                    $to = (array)$args['to'];
                    if($test) { 
                      $to[] = env('EMAIL_TEST_DEVELOPER');
                    }
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
        $user = \GlimGlam\Models\User::getRandom(); 
        $args['user'] = $user;
        $args['to'] = 'jdiaz@estrasol.com.mx';
        return self::sendMail('welcome', $args, $test, $send, $format);
    }
    // </editor-fold>
    public static function enrollment() {
       return view('mails.confirm-enrollment',[
           'user'=> \GlimGlam\Models\User::getRandom()
       ]);
    }
    
    public static function ConfirmYouWin() {
       return view('mails.confirm-you-win',[
           'user'=> \GlimGlam\Models\User::getRandom()
       ]);
    }
    
    public static function payment() {
        return view('mails.confirm-payment',[
           'user'=> \GlimGlam\Models\User::getRandom()
       ]);
    }
    
    public static function resetPassword() {
        return view('mails.reset-password',[
           'user'=> \GlimGlam\Models\User::getRandom()
        ]);
    }
    
}