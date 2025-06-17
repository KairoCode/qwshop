<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderGoods extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;
    protected $guarded = [];

    public function distribution()
    {
        return $this->hasOne("App\CloudErp\Models\Distribution", "goods_id", 'goods_id');
    }

    public function user()
    {
        return $this->hasOne("App\CloudErp\Models\User", "id", 'user_id');
    }
}
