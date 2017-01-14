<?php

namespace DwSetpoint\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use \DevTics\LaravelHelpers\Model\traits\MethodsModelBase;

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 0;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'cellphone', 'homephone'
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
    // <editor-fold defaultstate="collapsed" desc="addresses">
    public function addresses() {
        return $this->hasMany(Address::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="orders">
    public function orders() {
        return $this->hasMany(Order::class);
    }
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="billingInformation">
    public function billingInformation() {
        return $this->hasMany(BillingInformation::class);
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
    public function isAdmin () {
        return $this->profile_id == Profile::ADMIN;
    }
    public function isClient () {
        return $this->profile_id == Profile::CLIENT;
    }
    public function isMale(){
        return $this->gender == self::GENDER_MALE;
    }
    public function sendMailWelcome($rawPassword) {
        \DwSetpoint\Libs\Helpers\Mail::welcome([
            'user' => $this,
            'rawPassword' => $rawPassword
        ]);
    }
}
