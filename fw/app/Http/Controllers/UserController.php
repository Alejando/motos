<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DwSetpoint\Http\Controllers;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

/**
 * Description of CartController
 *
 * @author jdiaz
 */
class UserController  extends Controller {
    public function profile(){
        return view('user.pages.profile', [
            'showOffert' => false,
            'showBannerBottom' => false
            // 'menuUser' => true

        ]);
    }

    public function getOrders(){
        return view('user.pages.orders', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }

    public function getAddresses(){
        return view('user.pages.addresses', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
 	
 	// esta funcion es una prueba
    public function address(){
        return view('public.pages.address', [
            'showOffert' => false,
            'showBannerBottom' => false
        ]);
    }
    public function getFormReset(){
        return view('user.pages.resetPassword', [
            'showOffert' => false,
            'showBannerBottom' => false
            // 'menuUser' => true

        ]);
    }

    public function resetPassword(Request $request){

        $existingPassword=$request->input('existingPassword');
        $newPassword=$request->input('newPassword');
        $passwordConfirmed=$request->input('passwordConfirmed');

        if(Hash::check($existingPassword,Auth::user()->password)){
            if($newPassword==$passwordConfirmed){
                Auth::user()->password=$newPassword;
                Auth::user()->save();
                Session::flash('message','Tu contraseña se ha actualizado exitosamente');
            }else{
                Session::flash('message','La nueva contraseña "'.$newPassword. '" no coincide con "'.$passwordConfirmed.'"');
            }
        }else{
            Session::flash('message','La contraseña actual no coincide');
        }
        return redirect('restablecer/password');
    }
}
