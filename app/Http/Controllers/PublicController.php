<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class PublicController extends BaseController {
    // <editor-fold defaultstate="collapsed" desc="content">
    public function content($slug) {
        $objContent =\GlimGlam\Models\Content::getContetBySlug($slug);
        if($objContent) {
            return view('public.pages.content', [
                'objContent' => $objContent
            ]);
        }
        abort(404);
    }
    // </editor-fold>
}
