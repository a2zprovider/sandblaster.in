<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Setting;
use App\Models\Tag;
use Illuminate\Http\Request;
class ProductController extends Controller
{
    public function product(Request $request, Category $cat, $page)
    {
        $page = Page::where('slug', $page)->with('category')->firstOrFail();
        
        $faqs = Faq::where('category_id', 'LIKE', "%{$page->id}%")->get();
        $page_single = Page::whereNotIn('id', [$page->id])->take(6)->get();
        return view('frontend.pages.single', ["pages" => $page, "faqs" => $faqs, "pagesidebar" => $page_single]);      

    }   

    public function productList(){
        
        $products = Page::with('category')->latest()->get()->toArray();
        return view('frontend.pages.product', ["products" => $products]);
    }
    public function categoryProduct(Request $request, Category $category)
    {
        $query = Page::query();
        if ($request->s) {
            $query->where('title', 'LIKE', "%{$request->s}%");
        }
        $cat_product = $query->where('category_id', $category->id)->paginate(6);
       
        return view('frontend.pages.categorysingle', ["product" => $cat_product, "cat_slug"=>$category]);
    }    
}
