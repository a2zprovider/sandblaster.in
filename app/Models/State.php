<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $guarded = [];

    public function country()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
    protected $with = ['country'];
}
