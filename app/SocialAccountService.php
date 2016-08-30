<?php

namespace GlimGlam;
use GlimGlam\Models\User;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService {

    public function createOrGetUser(ProviderUser $providerUser) {
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
                $user = User::create([
                        'email' => $providerUser->getEmail(),
                        'name' => $providerUser->getName(),
                        'gender' => $providerUser->user['gender']==='male'
                ]);
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
