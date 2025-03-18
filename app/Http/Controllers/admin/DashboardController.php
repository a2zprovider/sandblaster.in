<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Inquery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Page::count();
        $category = Category::count();
        $blog = Post::count();
        $blogcategory = Blogcategory::count();
        $tag = Tag::count();
        $faq = Faq::count();

        $inquery = Inquery::count();

        $users = User::where('role', 'user')->get();
        foreach ($users as $key => $user) {
            if ($user->is_login == 'true') {
                if ($user->is_login_at != null) {
                    $t1 = date('Y-m-d H:i:s');
                    $t2 = date($user->is_login_at, 1);
                    $addingFiveMinutes = strtotime($t2 . ' + 2 hour');
                    $t3 = date('Y-m-d H:i:s', $addingFiveMinutes);
                    if (strtotime($t3) - strtotime($t1) < 0) {
                        $user->is_login =  'false';
                        $user->save();
                    }
                } else {
                    $user->is_login =  'false';
                    $user->save();
                }
            }
        }

        $data = compact('product', 'category', 'blog', 'blogcategory', 'tag', 'faq', 'inquery');
        return view('backend.inc.dashboard', $data);
    }
}
