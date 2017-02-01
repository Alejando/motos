<?php
namespace DwSetpoint\Libs\Helpers;
use \Mail as SendEmail;
/**
 * Description of SendMail
 *
 * @author jdiaz
 */
class MailBase {
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
                    $body = view($htmlView, $args)->render();
                    $message->getSwiftMessage()->setBody((new \Pelago\Emogrifier($body))-> emogrify());
                    $message->from([env('EMAIL_APP') => env('EMAIL_SENDERNAME')]);
                    $to = (array)$args['to'];
                    if($test) { 
                      $to[] = env('EMAIL_TEST_DEVELOPER');
                    }
                    $message->subject(isset($args['subject'])?$args['subject']:'No Subject');
                    if(isset($args['files-stream']) && is_array($args['files-stream'])){
                        foreach ($args['files-stream'] as $file){
                            $message->attachData($file['stream'], $file['name']);
                        }
                    }
                    $message->to($to);
                    if($args['fnPrepare']){
                        $args['fnPrepare']($message);
                    }
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
}
