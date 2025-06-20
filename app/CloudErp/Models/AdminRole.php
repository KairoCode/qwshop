<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminRole extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function permissions()
    {
        return $this->belongsToMany('App\CloudErp\Models\AdminPermission', 'admin_to_permissions', 'role_id', 'permission_id');
    }

    public function menus()
    {
        return $this->belongsToMany('App\CloudErp\Models\AdminMenu', 'admin_to_menus', 'role_id', 'menu_id')->orderBy('is_sort', 'asc');
    }
}
