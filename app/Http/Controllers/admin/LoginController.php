<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use Hash;
use App\Models\User;
use App\Models\Setting;

class LoginController extends Controller
{
    public function index()
    {
        $setting = Setting::first();

        $data = compact('setting');
        return view('backend.inc.login', $data);
    }
    public function checklogin(Request $request)
    {
        $rules = [
            "login"       => "required",
            "password"    => "required",
        ];
        $request->validate($rules);

        $user_data = array(
            'email'     => $request->login,
            'password'  => $request->password
        );

        $is_remembered = !empty($request->remember_me) ? true : false;
        if (Auth::guard('admin')->attempt($user_data, $is_remembered)) {

            $id = Auth::guard('admin')->user()->id;
            $user = User::find($id);
            $user->is_login =  'true';
            $user->is_login_at =  now();
            $user->save();

            return redirect(route('admin.home'))->with('success', 'Login successfully.');
        } else {
            return redirect()->back()->with('error', 'Credentials not matched.');
        }
    }

    public function logout()
    {
        $id = Auth::guard('admin')->user()->id;
        $user = User::find($id);
        $user->is_login =  'false';
        $user->save();

        Auth::guard('admin')->logout();

        return redirect(route('admin.login'))->with('success', 'Logout successfully.');
    }

    public function change_password()
    {
        if (!$this->checkPermisssion('change password')) {
            return view('backend.inc.auth');
        }
        return view('backend.inc.profile.changepassword');
    }

    public function save_password(Request $request)
    {
        $rules = [
            'new_password'     => 'required|string|min:8|same:new_password',
            'confirm_password' => 'required|string|min:8|same:new_password'
        ];
        $request->validate($rules);

        $new_password = Hash::make($request->new_password);
        Auth()->user()->update(['password' => $new_password]);
        return redirect()->back()->with('success', 'Your password has been changed successfully.');
    }
}
