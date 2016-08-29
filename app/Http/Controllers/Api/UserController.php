<?php

namespace GlimGlam\Http\Controllers\Api;

use Illuminate\Support\Facades\Input;
use GlimGlam\Models\User;

class UserController extends \GlimGlam\Libs\CoreUtils\ApiRestController {

    protected static $model = \GlimGlam\Models\User::class;

    public function getInputs() {
        $inputs = parent::getInputs();
        if (isset($inputs['birthday'])) {
            $dTemp = new \DateTime($inputs['birthday']);
            $dTemp->setTimezone(new \DateTimeZone("UTC"));
            $inputs['birthday'] = $dTemp;
        }
        return $inputs;
    }

    public function update(\Illuminate\Http\Request $request, $id) {
        $inputs = $this->getInputs();
        $user = User::getById($id);
        if (!isset($inputs['password'])) {
            return [
                'error' => true,
                'msj' => "Password requerido",
                'noError' => 1001
            ];
        }
        if (!\Hash::check($inputs['password'], $user->password)) {
            return [
                'error' => true,
                'msj' => "Contraseña invalida",
                'noError' => 1002
            ];
        }
        if (isset($inputs['newPassword'])) {
            $inputs['password'] = \Hash::make($inputs['newPassword']);
        } else {
            unset($inputs['password']);
        }
        $user->fill($inputs);
        $user->save();
        $res = ['succes' => true, 'model' => $user];
        $res['model']['birthday'] = $res['model']['birthday']->format(DATE_ISO8601);
        return $res;
    }

    public function getAuth() {
        return \Auth::user();
    }
    
    public function getFav($userId){
        $user = User::getById($userId);
        return $user->fav;
    }
    public function getWins($userId){
        $user = User::getById($userId);
        return $user->getWins();
    }
    public function addFav($code) {
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user->addFav($auction);
        return ['success' => true];
    }
    public function enrollments($userId){
        $user = User::getById($userId);
        return $user->getMyEnrolmentsAuctions();
    }
    public function getCurrentAuction(){
        $current = $user->getCurrentAuction();
        $uncoming = $user->getUpcomingAuctition();
        
        $upcoming = Auction::getUpcoming()->get();
        $upcoming->get()->get(rand(0, $upcoming->count()-1));
        return $upcoming;
    }
    public function auctionsInfo($userId) {
        $user = User::getById($userId);
        return $user->getAunctionsInfo();
    }
    public function getAvatar($userId = false) {
        /* @var $user User */
        if ($userId) {
            $user = User::getById($userId);
        } else {
            $user = \Auth::user();
        }
        if ($user->existsAvatar()) {
            $data = $user->getAvatar();
            $type = 'image/jpg';
        } else {
            $data = User::defaultAvatar();
            $type = User::defaultAvatarType();
        }
        return response($data)->header('Content-type', $type);
    }
   
    public function removeFav($code) {
        $user = \Auth::user();
        $auction = \GlimGlam\Models\Auction::getByCode($code);
        $user->removeFav($auction);
        return ['success' => true];
    }

    public function updateAvatar() {
        $user = \Auth::user();
        $img = $_FILES['img'];
        if ($img['type'] !== 'image/jpeg' && $img['type'] !== 'image/jpg') {
            return ['error' => 'Formato de imagen no valido'];
        }
        move_uploaded_file($img['tmp_name'], public_path('upload/avatars/' . $user->id . '.jpg'));
        return ['success' => true];
    }

}
