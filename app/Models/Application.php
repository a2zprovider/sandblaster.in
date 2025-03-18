<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function permission()
    {
        return $this->belongsToMany(User::class, 'permission_user')->withPivot('s_view', 's_add', 's_edit', 's_delete');
    }
}
