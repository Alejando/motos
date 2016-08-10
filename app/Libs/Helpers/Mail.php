<?php
namespace GlimGlam\Libs\Helpers;

class Mail{
    
    public static function welcome($args, $test = false, $send = true) {
       return view('mails.welcome',[
           'user'=> \GlimGlam\Models\User::getRandom()
       ]);
    }
    
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