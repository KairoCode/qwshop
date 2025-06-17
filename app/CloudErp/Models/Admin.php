<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory,HasApiTokens,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function findForPassport($login)
    {
        return $this->orWhere('username', $login)->first(); // ->orWhere('phone', $login)
    }

    public function roles()
    {
        return $this->belongsToMany('App\CloudErp\Models\AdminRole', 'admin_to_roles', 'admin_id', 'role_id');
    }
}
