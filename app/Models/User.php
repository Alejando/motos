<?php

namespace DwSetpoint\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use \DevTics\LaravelHelpers\Model\traits\MethodsModelBase;

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
    
    public function profile() {
        return $this->belongsTo(\DwSetpoint\Models\Profile::class);
    }
    
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }

}
