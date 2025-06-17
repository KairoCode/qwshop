<?php

namespace App\CloudErp\Models;

use App\CloudErp\Traits\TimeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Favorite extends Model
{
    use HasFactory,SoftDeletes,TimeTrait;

    protected $guarded = [];

    public function goods()
    {
        return $this->hasOne('App\CloudErp\Models\Goods', 'id', 'out_id')->withTrashed();
    }

    public function store()
    {
        return $this->hasOne('App\CloudErp\Models\Store', 'id', 'out_id')->withTrashed();
    }
}
