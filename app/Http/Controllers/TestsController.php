<?php

namespace DwSetpoint\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TestsController extends BaseController {
    public function crons(){
        return view('public.pages.crons');
    }
    public function mail(Request $request,$format='html',$type='welcome') {
        $mailClass = \DwSetpoint\Libs\Helpers\Mail::class;
        if(method_exists($mailClass, $type)){
            $methodRef = new \ReflectionMethod($mailClass, $type);
            $args = [];
            $to = $request->get('to');
            $args['to'] = $to ? $to : [];            
            $content = $methodRef->invokeArgs(null, [$args, true, $request->get('send')==='1', $format]);
            $response = \Response::make($content, '200');
            if($format === 'txt') {
                $response->header('Content-Type', 'text/plain');
            }
            return $response;
        }
        return "No existe el tipo de correo";
    }
}
