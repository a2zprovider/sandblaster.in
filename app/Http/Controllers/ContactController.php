<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Inquery;

class ContactController extends Controller
{
    public function contact(){
        $contact = Setting::first();
        // dd($contact);
        return view('frontend.pages.contact', ["contact"=>$contact]);
    }
    public function inquery(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'mobile' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',            
            'message' => 'required'
        ];
        $request->validate($rules);
        // dd($request->all());
        $input = $request->except(['_token', 'submit']);
        $inquery = new Inquery();
        $inquery->fill($input);
        $inquery->save();

        return redirect()->back()->with('success', 'Your Message Sended Successfully.');
    }
}
