<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Faq;
use App\Models\Inquery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Blogcategory;
use App\Models\Setting;
use App\Models\Application;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;


class HomeController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        $slider = Slider::get();
        $product = Page::latest()->get()->take(9);
        $products = Page::where('position', 'Low')->latest()->get()->take(9);
        $high = Page::where('position', 'High')->latest()->get()->take(8);
        

        $application = Application::latest()->get();
        $blog_cat = Post::latest()->get()->take(10);
        $faqs = Faq::whereRaw("find_in_set('home' , category_id)")->take(4)->get();
        $about = About::first();
        return view('frontend.inc.homepage', ['setting' => $setting, 'sliders' => $slider, 'application' => $application,  'product'=>$product, 'products' => $products, 'high_pro' => $high, 'faqs' => $faqs, 'about' => $about, 'blog_cat' => $blog_cat]);
    }

    public function about()
    {
        $setting = Setting::first();
        $about = About::first();
        $faqs = Faq::whereRaw("find_in_set('home' , category_id)")->take(4)->get();
        $data = compact('setting', 'about','faqs');
        return view('frontend.inc.about', $data);
    }

    public function contact()
    {
        $setting = Setting::first();

        $data = compact('setting');
        return view('frontend.inc.contact', $data);
    }
    public function page_list(Request $request)
    {
        $limit = 6;
        if ($request->limit) {
            $limit = $request->limit;
        }

        $setting = Setting::first();
        $query = Page::query();
       // dd ($qurery);
        if ($request->s) {
            $query->where('title', 'LIKE', "%{$request->s}%");
        }
       // $lists = $query->latest()->paginate($limit); get()
       $lists = $query->latest()->get(); 
        $recent_page = Page::paginate(10);
        $data = compact('setting', 'lists', 'recent_page');
        return view('frontend.inc.product', $data);
    }
    public function apl_list(Request $request)
    {
        $limit = 6;
        if ($request->limit) {
            $limit = $request->limit;
        }

        $setting = Setting::first();
        $query = Application::query();
        if ($request->s) {
            $query->where('name', 'LIKE', "%{$request->s}%");
        }
        $lists = $query->latest()->paginate($limit);
        $recent_page = Application::paginate(6);
        $data = compact('setting', 'lists', 'recent_page');
        return view('frontend.inc.application', $data);
    }
    public function blog_list(Request $request)
    {
        $query = Post::query();
        if ($request->s) {
            $query->where('title', 'LIKE', "%{$request->s}%");
        }
        $blogs = $query->get();
        //$blogs = Post::with('Blogcategory')->get();
        //$blogs = Post::where('category_id', $post->category_id)->take()->get();

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
        $setting = Setting::first();
        $blogsidebars = Post::take(7)->get();

        $tagb = Tag::take(7)->get();
       
        $blogcategories = Blogcategory::take(6)->get();

        return view('frontend.inc.blog', ["blogs" => $blogs, "tagb" =>$tagb, "blogsidebar" => $blogsidebars, "blogcategory" => $blogcategories, 'setting' => $setting]);
    }

    
    
    public function category($slug) {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $blogs = Post::where('category_id', $category->id)->paginate(10); 
        $setting = Setting::first();
        $blogcategory = Blogcategory::take(6)->get();
        $blogsidebar = Post::take(7)->get();
        $tagb = Tag::take(7)->get();

        return view('frontend.inc.blog', compact('category', 'blogs', 'setting','blogcategory','blogsidebar','tagb'));
    }

    public function tag($slug) {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        // $blogs = Post::where('tags', $tag->id)->paginate(10);     
        $blogs = Post::whereRaw("FIND_IN_SET(?, tags)", [$tag->id])->paginate(10);

        $setting = Setting::first();
        $blogcategory = Blogcategory::take(6)->get();
        $blogsidebar = Post::take(7)->get();
        $tagb = Tag::take(7)->get();

        return view('frontend.inc.blog', compact('tag', 'blogs', 'setting','blogcategory','blogsidebar','tagb'));
    }

   

public function filterByYear($year)
{
    $blogs = Post::whereYear('created_at', $year)->paginate(10);
    $blogcategory = BlogCategory::all();
    $blogsidebar = Post::latest()->take(5)->get();
    $tagb = Tag::all();
    $setting = Setting::first();

    return view('frontend.inc.blog', compact('blogs', 'blogcategory', 'blogsidebar', 'tagb','setting'));
}
    

    public function blog_detail(Request $request, Post $post)
    {
        $setting = Setting::first();
        $recent_blogs = Post::whereNotIn('id', [$post->id])->paginate(6);
        $blogsidebar = Post::take(7)->get();
        $blogcategory = Blogcategory::take(6)->get();
        //$blogs = Post::take(7)->get();
        $posttag = Tag::select('id', 'title', 'slug')->get();
        //dd($posttag);
        $tagb = Tag::take(7)->get();
        $blogs = Post::take(6)->get();
        $data = compact('setting', 'post', 'posttag', 'recent_blogs', 'blogsidebar','blogcategory','blogs','tagb');
        return view('frontend.inc.singleblog', $data);
    }

    public function page(Page $page)
    {
        $setting = Setting::first();
        $product_single = Page::where('category_id', $page->category_id)->whereNotIn('id', [$page->id])->take(6)->get();
        $recent_page = Page::paginate(6);
        $faqs = Faq::where('category_id', 'LIKE', "%{$page->id}%")->get();
        $related_post = Post::whereRaw("find_in_set( $page->id,products)")->latest()->get();
        $data = compact('setting', 'page', 'faqs', 'product_single', 'recent_page', 'related_post');
        return view('frontend.inc.singleproduct', $data);
    }
    public function apl_detail(Request $request, Application $app)
    {
        $setting = Setting::first();
        $recent_pages = Application::whereNotIn('id', [$app->id])->paginate(4);
        $recent_page = Application::paginate(6);
        $data = compact('setting', 'app', 'recent_pages', 'recent_page');
        return view('frontend.inc.singleapplication', $data);
    }

    public function inqueryblog(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ];
        $request->validate($rules);

        $input = $request->except('_token', 'submit', 'g-recaptcha-response');
        $inquery = new Inquery();
        $inquery->fill($input);

        $inquery->save();
       // $response = Http::post('https://inquiry.airoshotblast.in/api/enquiry/cutwire.in/', $input);
        return redirect()->back()->with('success', 'Your Message Sended Successfully.');
    }

    public function inqueryss(Request $request)
    {
        // Validate form inputs
        $validator = Validator::make($request->all(), [
            'name'    => 'required|min:3',
            'email'   => 'required|email',
            'mobile'  => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'message' => 'required|min:5',
            'g-recaptcha-response' => 'required'
        ]);

        // Check for validation failure
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        // If validation passes, you can store the data in the database
        // Contact::create($request->all());

        return response()->json(['success' => true, 'message' => 'Thank you! Your inquiry has been submitted.']);
    }

    
    public function inquery(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            // 'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
        ];
        $request->validate($rules);

        $input = $request->except('_token', 'submit', 'g-recaptcha-response');
        $inquery = new Inquery();
        $inquery->fill($input);
        // dd($inquery);
        $inquery->save();
       
       if ($rules->fails()) {
        return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
    }

    // If validation passes, you can store the data in the database
    // Contact::create($request->all());

    return response()->json(['success' => true, 'message' => 'Thank you! Your inquiry has been submitted.']);
       


    }
    public function inquerysp(Request $request)
    {
        $rules = [
            'name' => 'required',
            
            'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
           
            'g-recaptcha-response' => 'required'
        ];
        $request->validate($rules);

        $input = $request->except('_token', 'submit', 'g-recaptcha-response');
        $inquery = new Inquery();
        $inquery->fill($input);
        // dd($inquery);
        $inquery->save();
        //$response = Http::post('https://inquiry.airoshotblast.in/api/enquiry/cutwire.in/', $input);
        return redirect()->back()->with('success', 'Thank you for your inquiry! You will receive our catalog with latest price soon.');
        
    }
    public function ajexinquery(Request $request)
    {

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email',
                'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'subject' => 'required',
                'message' => 'required',
                'g-recaptcha-response' => 'required'
            ];
            $request->validate($rules);

            $input = $request->except('_token', 'submit', 'g-recaptcha-response');
            $inquery = new Inquery();
            $inquery->fill($input);

            if ($inquery->save()) {
                //$response = Http::post('https://enquiry.sandblastingmachine.in/api/enquiry/cutwire.in/', $input);

                $re = [
                    'status' => 'success',
                    "msg" => "successfully"
                ];
                return response()->json($re);
            } else {
                $re = [
                    'status' => 'faild',
                    "msg" => "faild"
                ];
                return response()->json($re);
            }
        } catch (Exception $e) {

            $re = [
                'status' => 'faild',
                "msg" => "<p>Mobile number should be 10 character long <br></p>"
            ];
            return response()->json($re);
        }
    }


    public function sitemap()
    {
        $products = Page::get();
        $blogs = Post::get();
        $applications = Application::get();
        $data = compact('products', 'blogs', 'applications');
        return response()->view('sitemap', $data)->header('Content-Type', 'text/xml');
    }
}
