<?php

namespace GlimGlam\Http\Controllers;

session_start();

use GlimGlam\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class FacebookController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $config;
    private $facebook;

    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login() {
        return \Socialite::driver('facebook')->redirect();
    }

    public function checkin(\GlimGlam\SocialAccountService $service) {
        $user = $service->createOrGetUser(\Socialite::driver('facebook')->user());
        auth()->login($user);
        return redirect()->to(route('my-profile'));
    }

}
