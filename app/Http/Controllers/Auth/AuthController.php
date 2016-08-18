<?php

namespace GlimGlam\Http\Controllers\Auth;

use GlimGlam\Models\User;
use Validator;
use GlimGlam\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Registration & Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users, as well as the
      | authentication of existing users. By default, this controller uses
      | a simple trait to add these behaviors. Why don't you explore it?
      |
     */

    use AuthenticatesAndRegistersUsers {
        redirectPath as redirectTrait;
    }
    
    use ThrottlesLogins;
    
    
    public function redirectPath() {
        if(\Auth::user() && \Auth::user()->profile===User::PROFILE_ADMIN){
            return "admin";
        }
       return $this->redirectTrait();
    }
    
    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
                    'gender' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
        ]);
        \GlimGlam\Libs\Helpers\Mail::welcome([
            'user' => $user,
            'to' => $user->email
        ]);
        return $user;
    }

    protected function getFailedLoginMessage() {
        return 'La dirección de correo electrónico y la contraseña que has introducido no coinciden';
    }

    

}
