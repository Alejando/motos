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
    public function login(Request $request) {
        $request->session()->flash('fb_prev_url', \URL::previous());       
        return \Socialite::driver('facebook')->redirect();
    }

    public function checkin(\GlimGlam\SocialAccountService $service, Request $request) {
        try{
            $user = $service->createOrGetUser(\Socialite::driver('facebook')->user());
            auth()->login($user);
            return redirect()->to(route('my-profile'));
        } catch(\Exception $ex) {
            $fb_prev_url = $request->session()->get('fb_prev_url');
            return redirect()->to($fb_prev_url);
        }
    }

}
