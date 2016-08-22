<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class ProcessController extends BaseController {
    public function index(){
        
    }
    public function startAuctions(){
        return \GlimGlam\Models\Auction::startAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
    public function closeAuctions(){
        return \GlimGlam\Models\Auction::closeAuctions();
        return (new \DateTime)->format(DATE_ATOM);
    }
}
