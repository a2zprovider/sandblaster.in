<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];

    public function state()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
    protected $with = ['state'];
}
