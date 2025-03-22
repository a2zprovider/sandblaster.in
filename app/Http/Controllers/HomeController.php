<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Country;
use App\Models\Faq;
use App\Models\Inquery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Blogcategory;
use App\Models\Productfilter;
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
        $countries = Country::get();
        return view('frontend.inc.homepage', ['setting' => $setting, 'sliders' => $slider, 'application' => $application, 'product' => $product, 'products' => $products, 'high_pro' => $high, 'faqs' => $faqs, 'about' => $about, 'blog_cat' => $blog_cat, 'countries' => $countries]);
    }

    public function about()
    {
        $setting = Setting::first();
        $about = About::first();
        $countries = Country::get();
        $faqs = Faq::whereRaw("find_in_set('home' , category_id)")->take(4)->get();
        $data = compact('setting', 'about', 'faqs', 'countries');
        return view('frontend.inc.about', $data);
    }

    public function contact()
    {
        $setting = Setting::first();
        $countries = Country::get();

        $data = compact('setting', 'countries');
        return view('frontend.inc.contact', $data);
    }
    public function page_list(Request $request)
    {
        $limit = 100;
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

        $recent_page = Page::paginate(10);
        $categories = Category::latest()->get();
        $selected_category = $request->query('category');
        $filters = [];
        $productfilters = '';
        $selected_category_details = '';
        if ($selected_category) {
            $selected_category_details = Category::where('slug', $selected_category)->firstOrFail();
            if (@$selected_category_details->filter && @$selected_category_details->filter != null && @$selected_category_details->filter != '') {
                $filters = explode(',', $selected_category_details->filter);
            } else {
                $filters = [];
            }
            $productfilters = Productfilter::whereNull('parent')->whereIn('id', $filters)->get();

        } else {
            $productfilters = Productfilter::whereNull('parent')->get();
        }
        // dd($selected_category_details);

        foreach ($productfilters as $key => $pf) {
            $productfilters1 = Productfilter::where('parent', $pf->id)->get();
            $pf->filters = $productfilters1;
        }
        if ($selected_category) {
            $query = $query->where('category_id', $selected_category_details->id);
        }
        $afs = [];
        $allselectedfilter = [];
        $allfilters = Productfilter::whereNull('parent')->get();
        foreach ($allfilters as $key => $af) {
            if ($request->query($af->slug)) {
                $f_detail = Productfilter::where('slug', $request->query($af->slug))->firstOrFail();
                $allselectedfilter[] = $f_detail;
                $afs[] = $f_detail->id;
            }
        }
        if (count($afs)) {
            $query = $query->whereRaw("FIND_IN_SET(?, filter)", $afs);
        }
        $lists = $query->latest()->get();

        $r_query = $request->query();
        // dd($r_query);
        $data = compact('setting', 'lists', 'recent_page', 'categories', 'productfilters', 'r_query', 'allselectedfilter', 'selected_category_details');
        return view('frontend.inc.product', $data);
    }

    public function ajaxProductDetails(Request $request, $slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $filters = [];
        $category = Category::findOrFail($page->category_id);
        if (@$category->filter && @$category->filter != null && @$category->filter != '') {
            $filters = explode(',', $category->filter);
        } else {
            $filters = [];
        }
        $productfilters = Productfilter::whereNull('parent')->whereIn('id', $filters)->get();
        foreach ($productfilters as $key => $pf) {
            $productfilters1 = Productfilter::where('parent', $pf->id)->get();
            $pf->filters = $productfilters1;
        }

        $afs = [];
        $allfilters = Productfilter::whereNull('parent')->get();
        foreach ($allfilters as $key => $af) {
            if ($request->query($af->slug)) {
                $f_detail = Productfilter::where('slug', $request->query($af->slug))->firstOrFail();
                $afs[] = $f_detail->id;
            }
        }
        $lists = [];
        if (count($afs)) {
            $query1 = Page::where('category_id', $category->id);
            if (!empty($afs)) {
                foreach ($afs as $af) {
                    $query1 = $query1->whereRaw("FIND_IN_SET(?, filter)", [$af]);
                }
            }
            $lists = $query1->get();
        }

        return response()->json(['filters' => $productfilters, 'category' => $category, 'products' => $lists]);
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

        return view('frontend.inc.blog', ["blogs" => $blogs, "tagb" => $tagb, "blogsidebar" => $blogsidebars, "blogcategory" => $blogcategories, 'setting' => $setting]);
    }

    public function category($slug)
    {
        $category = BlogCategory::where('slug', $slug)->firstOrFail();
        $blogs = Post::where('category_id', $category->id)->paginate(10);
        $setting = Setting::first();
        $blogcategory = Blogcategory::take(6)->get();
        $blogsidebar = Post::take(7)->get();
        $tagb = Tag::take(7)->get();

        return view('frontend.inc.blog', compact('category', 'blogs', 'setting', 'blogcategory', 'blogsidebar', 'tagb'));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();
        // $blogs = Post::where('tags', $tag->id)->paginate(10);     
        $blogs = Post::whereRaw("FIND_IN_SET(?, tags)", [$tag->id])->paginate(10);

        $setting = Setting::first();
        $blogcategory = Blogcategory::take(6)->get();
        $blogsidebar = Post::take(7)->get();
        $tagb = Tag::take(7)->get();

        return view('frontend.inc.blog', compact('tag', 'blogs', 'setting', 'blogcategory', 'blogsidebar', 'tagb'));
    }
    public function filterByYear($year)
    {
        $blogs = Post::whereYear('created_at', $year)->paginate(10);
        $blogcategory = BlogCategory::all();
        $blogsidebar = Post::latest()->take(5)->get();
        $tagb = Tag::all();
        $setting = Setting::first();

        return view('frontend.inc.blog', compact('blogs', 'blogcategory', 'blogsidebar', 'tagb', 'setting'));
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
        $data = compact('setting', 'post', 'posttag', 'recent_blogs', 'blogsidebar', 'blogcategory', 'blogs', 'tagb');
        return view('frontend.inc.singleblog', $data);
    }

    public function page(Page $page)
    {
        $setting = Setting::first();
        $product_single = Page::where('category_id', $page->category_id)->whereNotIn('id', [$page->id])->take(6)->get();
        $recent_page = Page::paginate(6);
        $faqs = Faq::where('category_id', 'LIKE', "%{$page->id}%")->get();
        $related_post = Post::whereRaw("find_in_set( $page->id,products)")->latest()->get();
        $countries = Country::get();
        $data = compact('setting', 'page', 'faqs', 'product_single', 'recent_page', 'related_post', 'countries');
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
            'name' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
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
        $inquery->save();

        return redirect()->back()->with('success', 'Thank you! Your inquiry has been submitted.');


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
        return response()->json([
            'message' => 'Thank you for your inquiry! You will receive our catalog with latest price soon.',
            'data' => $inquery
        ]);

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
