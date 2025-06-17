<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cart extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function goods()
    {
        return $this->hasOne('App\CloudErp\Models\Goods', 'id', 'goods_id')->withTrashed();
    }

    public function store()
    {
        return $this->hasOne('App\CloudErp\Models\Store', 'id', 'store_id')->withTrashed();
    }

    public function carts()
    {
        return $this->hasMany('App\CloudErp\Models\Cart', 'store_id', 'store_id');
    }

    public function goods_sku()
    {
        return $this->hasOne('App\CloudErp\Models\GoodsSku', 'id', 'sku_id');
    }
}
