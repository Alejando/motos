<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
class TestPakoCtrl extends BaseController {
    /**
     * Ejemplo de como obtener los covers de una subasta
     * @return type
     */
    public function getCovers(){
        $auction = \GlimGlam\Models\Auction::getByCode('SUB-001');
        return [
            'horizotal' => $auction->getUrlCover(\GlimGlam\Models\Auction::COVER_HORIZONTAL),
            'vertical' => $auction->getUrlCover(\GlimGlam\Models\Auction::COVER_VERTICAL),
            'slider-upcoming' => $auction->getUrlCover(\GlimGlam\Models\Auction::COVER_SLIDER_UPCOMING),
            'covers' => $auction->getCovers()
        ];
    }
    
    public function getIndex(){
        return [
            url('/tests/pako/covers') 
        ];
    }
}
