<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IntegralOrder extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\CloudErp\Models\User', 'id', 'user_id');
    }

    public function integral_order_goods()
    {
        return $this->hasMany('App\CloudErp\Models\IntegralOrderGoods', 'order_id', 'id');
    }
}
