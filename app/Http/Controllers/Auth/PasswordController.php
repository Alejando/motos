<?php

namespace GlimGlam\Http\Controllers\Auth;

use GlimGlam\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }
    public $redirectTo = "/mi-perfil";
    protected $subject = "Recuperación de contraseña";
    protected function resetEmailBuilder() {
        return function (\Illuminate\Mail\Message $message) {
            $body = $message->getSwiftMessage()->getBody();
            $message->getSwiftMessage()->setBody((new \Pelago\Emogrifier($body))->emogrify());
            $message->subject($this->getEmailSubject());
        };
    }

}
