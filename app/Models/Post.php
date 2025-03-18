<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $withs = ['blogcategory', 'tag'];

    public function blogcategory()
    {
        return $this->hasOne('App\Models\Blogcategory', 'id', 'category_id');
    }
    public function tag()
    {
        return $this->hasOne('App\Models\Tag', 'id', 'tags');
    }

    public function permission()
    {
        return $this->belongsToMany(User::class, 'permission_user')->withPivot('s_view', 's_add', 's_edit', 's_delete');
    }
}
