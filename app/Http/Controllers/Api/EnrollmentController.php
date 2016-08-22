<?php
namespace GlimGlam\Http\Controllers\Api;
class EnrollmentController extends \GlimGlam\Libs\CoreUtils\ApiRestController{
    protected static $model = \GlimGlam\Models\Enrollment::class;
    
    public function userIsEnrollment($auctionCode){
        $ok = false;
        if(\Auth::check()){
            $user = \Auth::user();
            $ok = \GlimGlam\Models\Enrollment::userIsEnrollment($auctionCode, $user->id);
        }
        return [
            'enrollment' => $ok
         ];
    }
    
}