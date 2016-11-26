<?php

namespace DwSetpoint\Http\Controllers;

use DwSetpoint\Http\Requests;
use Illuminate\Http\Request;

class ContentCtrl extends Controller {

    public function slug($slug){
    	$content = \DwSetpoint\Models\Content::getContetBySlug($slug);
    	if($content == null){
    		abort(404);
    	}
    	return view('public.pages.content',[
            'showOffert' => false,
            'showBannerBottom' => false,
            'content' => $content
        ]);
    }

}
