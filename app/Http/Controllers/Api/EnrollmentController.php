<?php
namespace GlimGlam\Http\Controllers\Api;
class EnrollmentController extends \GlimGlam\Libs\CoreUtils\ApiRestController{
    protected static $model = \GlimGlam\Models\Enrollment::class;
    
    public function userIsEnrollment($auctionCode){
        if(\Auth::check()){
            $user = \Auth::user();
            return [
               'enrollment' => \GlimGlam\Models\Enrollment::userIsEnrollment($auctionCode, $user->id)
            ];
        }
        return false;
    }
    
}