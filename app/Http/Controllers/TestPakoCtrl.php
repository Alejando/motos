<?php

namespace GlimGlam\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
class TestPakoCtrl extends BaseController {
    // <editor-fold defaultstate="collapsed" desc="getCovers">
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
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getIndex">
    public function getIndex(){
        return [
            url('/tests/pako/covers') 
        ];
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getStartedAuctions">
    public function getStartedAuctions(){
        return \GlimGlam\Models\Auction::where('status','=',  \GlimGlam\Models\Auction::STATUS_STARTED)
                ->paginate(4);
    }
    // </editor-fold>
    
}
