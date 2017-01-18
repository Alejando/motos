<?php
namespace DwSetpoint\Models;
class Profile  extends \DevTics\LaravelHelpers\Model\ModelBase{
    const ADMIN = 1;
    const CLIENT = 2;

    // <editor-fold defaultstate="collapsed" desc="users">
    public function users() {
        return $this->hasMany(User::class);
    }
    // </editor-fold>
}