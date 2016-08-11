<?php

namespace GlimGlam\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TestsController extends BaseController {
    public function mail(Request $request,$format='html',$type='welcome') {
        $mailClass = \GlimGlam\Libs\Helpers\Mail::class;
        if(method_exists($mailClass, $type)){
            $methodRef = new \ReflectionMethod($mailClass, $type);
            $content = $methodRef->invokeArgs(null, [[], true, $request->get('send')==='1', $format]);
            $response = \Response::make($content, '200');
            if($format === 'txt') {
                $response->header('Content-Type', 'text/plain');
            }
            return $response;
        }
        return "No existe el tipo de correo";
    }
}
