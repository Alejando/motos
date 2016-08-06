<?php

namespace GlimGlam\Models;


class Auction extends \GlimGlam\Libs\CoreUtils\ModelBase{
    
    public $timestamps = true;
    const FINISHED = 2;
    const STARTED = 1;
    const STAND_BY = 0;
    
    public static function getByCode($code) {
        $auctions = self::where('code',$code)->get();
        if(count($auctions)){
            return $auctions[0];
        }
       abort(404);
    }
}