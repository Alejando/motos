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
    public static function getEnrollments($user_id = false,  $auction = false, $returnQuery = false) {
        $query = Enrollment::query();
        if($user_id){
            $query->where('user', '=', $user_id);
        }
        if($auction){
            $query->where('auction', '=', $auction);
        }
        if($returnQuery){
            return $query;
        }
        return $query->get();
    }
    
    public function getNextPenaltyDateTime(){
        return new \DateTime($this->attributes['next_penalty']);
    }
}