<?php

namespace DwSetpoint\Http\Controllers\Auth;

use DwSetpoint\Models\User;
use Validator;
use DwSetpoint\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
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
        login as parentLogin;
    }
    use ThrottlesLogins;

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
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
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
            'password' => $data['password'],
        ]);
        $user->sendMailWelcome($data['password']);
        return $user;
    }
    public function login(\Illuminate\Http\Request $request) {
        if ($request->ajax()) {
            $this->validateLogin($request);
            $credentials = $this->getCredentials($request);
             if (\Auth::guard($this->getGuard())->attempt($credentials, $request->has('remember'))) {
                return [
                    'success' => true
                ];
            }
            return [
                'error' => true,
                'message' => 'Password o usuario incorrectos'
            ];
        }
        $res = $this->parentLogin($request);
        $user = auth()->user();
//        dd(route('admin.index'));
        if( $user && $user->isAdmin()) {            
            return redirect(route('admin.index'));
        }
        return $res;
    }
}
