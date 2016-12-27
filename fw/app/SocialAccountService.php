<?php

namespace DwSetpoint;
use DwSetpoint\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService {

    public function createOrGetUser(ProviderUser $providerUser) {
//         dd($providerUser);
         $account = Models\SocialAccount::whereProvider('facebook')
                ->whereProviderUserId($providerUser->getId())
                ->first();
        if ($account) {
            return $account->user;
        } else {
            
            $account = new Models\SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider' => 'facebook'
            ]);
            $user = User::whereEmail($providerUser->getEmail())->first();
            if (!$user) {
                $pass = str_random(8);
                $user = new User();
                $user->fill([
                        'email' => $providerUser->getEmail(),
                        'name' => $providerUser->getName(),
                        'gender' => $providerUser->user['gender']==='male',
                        'password' => \Hash::make($pass)
                ]);
                   $user->save();
                $user->sendMailWelcome($pass);
            }
            $account->user()->associate($user);
            $account->save();
            $avatarPath = public_path('upload/avatars/'.$user->id) . '.jpg';
            $avatarOrg = file_get_contents($providerUser->avatar_original);
            file_put_contents($avatarPath, $avatarOrg );
            return $user;
        }
       
    }

}
