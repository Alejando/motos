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
    // <editor-fold defaultstate="collapsed" desc="profile">
    public function profile() {
        return $this->belongsTo(\DwSetpoint\Models\Profile::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="bookmarks">
    public function bookmarks() {
        return $this->belongsToMany(Product::class,'bookmarks');
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="setPasswordAttribute">
    public function setPasswordAttribute($password) {
        $this->attributes['password'] = \Hash::make($password);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="addBookmark">
    public function addBookmark($id_product){
        try{
            $this->bookmarks()->attach($id_product);
            return true;
        }catch(\Exception $ex){
            return false;
        }
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="deleteBookmark">
    public function deleteBookmark($id_product){
        $this->bookmarks()->detach($id_product);
    }
    // </editor-fold>

}
