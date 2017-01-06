<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use DwSetpoint\Http\Requests;
use Mail;
use \stdClass;

class ContactCtrl extends Controller {
    public function index(){
        return view('public.pages.contact',[
            'showOffert' => false,
            'showBannerBottom' => false,
            'Mge_sent' => false
        ]);
    }

    public function get_info_contacto(){
    	$contacto_info = new stdClass;;
     	$contacto_info->nombre = "Gael Geovani Manzanares Quiñones";
     	$contacto_info->movil = '4921611742';
     	$contacto_info->correo = 'gmanzanares@estrasol.com.mx';
     	$contacto_info->forma = 'Movil';
     	$contacto_info->hora_inicio = '14:00';
     	$contacto_info->hora_final = '12:00';
     	$contacto_info->mensaje = 	'Quiero informacion sobre los tenis que vi en la pagina no tiene stock asi que me preguntaba cuando tendrian 
                					y cual es el precio que deberia pagar si lo compro via internet , me gustuaria conocer hcahr dde suy porhd  ya qye 
                					invesighs en la paguina y no encuento nada';

        return view('mails.html.info_contacto',[
         	'contacto_info' => $contacto_info
        ]);
    }

    public function sendInfoContact(Request $request){

    	$contacto_info = new stdClass;;
     	$contacto_info->nombre = $request->input('nombre');
     	$contacto_info->movil = $request->input('movil');
     	$contacto_info->correo = $request->input('correo');
     	$contacto_info->forma = $request->input('forma');
     	$contacto_info->hora_inicio = $request->input('hora_inicio');
     	$contacto_info->hora_final = $request->input('hora_final');
     	$contacto_info->mensaje = $request->input('mensaje');

        Mail::send('mails.html.info_contacto', ['contacto_info' => $contacto_info], function ($m) use ($request) {
            $m->from('webtest@estrasol.com.mx', 'Administración Contacto Bounce');

            $m->to('hola@bounce.com.mx', 'Bounce Admin')->subject('Solicitud de informes Bounce');
        });
        return view('public.pages.contact',[
            'showOffert' => false,
            'showBannerBottom' => false,
            'Mge_sent' => true
        ]);
    }
}
