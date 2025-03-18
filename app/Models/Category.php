<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $with = ['page'];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'category_id', 'id');
    }
    public function page()
    {
        return $this->hasMany('App\Models\Page', 'category_id', 'id');
    }
}
