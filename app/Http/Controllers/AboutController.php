<?php

namespace App\Http\Controllers;
use App\Models\Setting;

use Illuminate\Http\Request;
use App\Models\About;
class AboutController extends Controller
{
    public function about(){
        $setting = Setting::first();

        $abouts = About::first(); 
        return view('frontend.pages.about', ["about"=>$abouts, 'setting'=>$setting]);
    }
}
