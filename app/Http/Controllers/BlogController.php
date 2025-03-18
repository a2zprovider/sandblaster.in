<?php

namespace App\Http\Controllers;

use App\Models\Blogcategory;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function blog(Request $request)
    {
        $query = Post::query();
        if ($request->s) {
            $query->where('title', 'LIKE', "%{$request->s}%");
        }
        $blogs = $query->paginate(2);
        if (!$blogs->isEmpty()) {
            foreach ($blogs as $k => $l) {
                $tagArr = [];
                if (!empty($l->tags)) {
                    $tags = Tag::whereIn('id', explode(",", $l->tags))->select('id', 'title', 'slug')->get();
                    $tagArr = $tags;
                }
                $blogs[$k]->tagArr = $tagArr;

                $categoryArr = [];
                if (!empty($l->category_id)) {
                    $category = Blogcategory::whereIn('id', explode(",", $l->category_id))->select('id', 'title', 'slug')->get();
                    $categoryArr = $category;
                }
                $blogs[$k]->categoryArr = $categoryArr;
            }
        }
        $settings = Setting::first();
        $blogsidebars = Post::take(7)->get();
        $blogcategories = Blogcategory::take(6)->get();
        return view('frontend.pages.blog', ["blog" => $blogs, "blogsidebar" => $blogsidebars, "blogcategory" => $blogcategories, 'setting' => $settings]);
    }

    public function blogdetail(Post $blogdetail)
    {
        // dd($blogdetail);
        $categoryArr = [];
        if (!empty($blogdetail->category_id)) {
            $categoryArr = Blogcategory::whereIn('id', explode(",", $blogdetail->category_id))->select('id', 'title', 'slug')->get()->toArray();
        }
        $blogdetail->categoryArr =  $categoryArr;

        $blogcategories = Blogcategory::take(7)->get();
        $blog_single = Post::whereNotIn('id', [$blogdetail->id])->latest()->take(7)->get();
        // dd($blog_single);
        return view('frontend.pages.blogdetail', ['blog' => $blogdetail, 'blogsingle' => $blog_single, 'blogcategory' => $blogcategories]);
    }
}
