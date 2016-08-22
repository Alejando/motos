<?php

namespace GlimGlam\Http\Controllers;
session_start();
use GlimGlam\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
class FacebookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $config;
    private $facebook;
    
    public function __construct()
    {
        $this->config = array(
            'app_id' => \Config::get('facebook.appId'),
            'app_secret' => \Config::get('facebook.secret'),
        );
    
        $this->facebook = new \Facebook\Facebook($this->config);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        $permissions = ['email']; // optional

        $loginUrl = $helper->getLoginUrl(route('facebook.checkin'), $permissions);
        
        return redirect($loginUrl);
    }
    public function checkin(){
        try {
                $code = Input::get('code');
            
            $helper = $this->facebook->getRedirectLoginHelper();
            dd($helper);
            $accessToken = $helper->getAccessToken();

            // Returns a `Facebook\FacebookResponse` object
            $response = $this->facebook->get('/me?fields=id,name,work,website,email,first_name,birthday', $accessToken);
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();

        echo 'Name: ' . $user['name'];
        dd('hola');
    }
}