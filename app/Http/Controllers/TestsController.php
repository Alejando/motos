<?php

namespace GlimGlam\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class TestsController extends BaseController {
    public function mail(Request $request,$type) {
        $mailClass = \GlimGlam\Libs\Helpers\Mail::class;
        if(method_exists($mailClass, $type)){
            $methodRef = new \ReflectionMethod($mailClass, $type);
            return $methodRef->invokeArgs(null, [[], true, $request->get('send')==='1']);
        }
        return "No existe el tipo de correo";
    }
}
