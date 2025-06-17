<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderComment extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne('App\CloudErp\Models\User', 'id', 'user_id')->withTrashed();
    }

    public function store()
    {
        return $this->hasOne('App\CloudErp\Models\Store', 'id', 'store_id')->withTrashed();
    }

    public function goods()
    {
        return $this->hasOne('App\CloudErp\Models\Goods', 'id', 'goods_id')->withTrashed();
    }
}
