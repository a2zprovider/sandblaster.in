<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }
    public function blogcategory()
    {
        return $this->hasOne('App\Models\Blogcategory', 'id', 'category_id');
    }

    public function permission()
    {
        return $this->belongsToMany(User::class, 'permission_user')->withPivot('s_view', 's_add', 's_edit', 's_delete');
    }
}
