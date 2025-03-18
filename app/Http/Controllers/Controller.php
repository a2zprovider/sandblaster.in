<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function checkPermisssion($page)
    {
        $user = User::find(auth()->user()->id);
        if ($user->role != 'admin') {
            $ids = [];
            foreach ($user->permission as $u_p) {
                $ids[] = $u_p->name;
            }
            if (!in_array($page, $ids)) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}
