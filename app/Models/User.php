<?php

namespace GlimGlam\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    const PROFILE_CLIENT = 1;
    const PROFILE_ADMIN = 2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function isAdmin() {
        return $this->perfil == self::PROFILE_ADMIN;
    }
    
    public function isClient() {
        return $this->profile == self::PROFILE_ADMIN;
    }

}
