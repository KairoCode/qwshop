<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Store extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function storeClasses()
    {
        return $this->hasOne('App\CloudErp\Models\StoreClass', 'store_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany('App\CloudErp\Models\OrderComment', 'store_id', 'id');
    }

    public function orders()
    {
        return $this->hasMany('App\CloudErp\Models\Order', 'store_id', 'id');
    }
}
