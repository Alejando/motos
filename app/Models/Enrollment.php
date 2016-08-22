<?php
namespace GlimGlam\Models;

class Enrollment extends \GlimGlam\Libs\CoreUtils\ModelBase{
    public static function userIsEnrollment($auctionCode, $userId) {
        $enrrollment = self::where('user', '=', $userId)
                ->where('auction', '=', Auction::getByCode($auctionCode)->id)
                ->get();
        if(count($enrrollment)) {
            return true;
        }
        return false;
    }
}