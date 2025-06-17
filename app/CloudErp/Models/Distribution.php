<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Distribution extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function goods()
    {
        return $this->hasOne('App\CloudErp\Models\Goods', 'id', 'goods_id')->withTrashed();
    }
}
