<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view users')) {
            return view('backend.inc.auth');
        }
        $permissions = ['view products', 'add products', 'edit products', 'delete products',  'view applications', 'add applications', 'edit applications', 'delete applications', 'view blogcategory', 'add blogcategory', 'edit blogcategory', 'delete blogcategory', 'view category', 'add category', 'edit category', 'delete category', 'view faqs', 'add faqs', 'edit faqs', 'delete faqs', 'view blogs', 'add blogs', 'edit blogs', 'delete blogs', 'view slider', 'add slider', 'edit slider', 'delete slider', 'view tags', 'add tags', 'edit tags', 'delete tags', 'view users', 'add users', 'edit users', 'delete users', 'about', 'setting', 'inquiry', 'change password', 'homeedit'];

        foreach ($permissions as $key => $value) {
            $slug = Str::slug($value);
            $exists = Permission::where('slug', $slug)->exists();
            if (!$exists) {
                $permission = Permission::create(['name' => $value, 'slug' => $slug]);
            }
        }

        if ($request->ajax()) {
            $data = User::where('role', 'user')->select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.user.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->checkPermisssion('add users')) {
            return view('backend.inc.auth');
        }
        $permissions = Permission::get()->pluck('name', 'id');

        $data = compact('permissions');
        return view('backend.inc.user.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'name'  => 'required|string',
            'email'  => 'required|email',
        ];

        $messages = [
            'name'  => 'Please Enter Name.',
            'email'  => 'Please Enter Email.',
        ];

        $request->validate($rules, $messages);

        $record           = new User;
        $input            = $request->except('_token', 'password', 'permission');

        $input['role'] = 'user';
        $input['password'] = Hash::make($request->password);
        $record->fill($input);
        if ($record->save()) {
            if (@$request->permission) {
                $record->permission()->sync((array)$request->permission);
            }
            return redirect(route('admin.user.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.user.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(User $user)
    {
        //
    }

    public function profile()
    {
        $user = Auth()->user();

        $data = compact('user');
        return view('backend.inc.profile.index', $data);
    }

    public function edit(Request $request, User $user)
    {
        if (!$this->checkPermisssion('edit users')) {
            return view('backend.inc.auth');
        }
        $editData =  $user->toArray();
        $request->replace($editData);
        $request->flash();

        $permissions = Permission::get()->pluck('name', 'id');

        $data = compact('user', 'permissions');
        return view('backend.inc.user.edit', $data);
    }

    public function update(Request $request, User $user)
    {
        $record     = $user;
        $input      = $request->except('_token', '_method', 'password', 'permission');
        if ($request->password) {
            $input['password'] = Hash::make($request->password);
        } else {
        }

        $record->fill($input);
        if ($record->save()) {
            if (@$request->permission) {
                $record->permission()->sync((array)$request->permission);
            }
            return redirect(route('admin.user.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function destroy(User $user)
    {
        if (!$this->checkPermisssion('delete users')) {
            return view('backend.inc.auth');
        }
        $user->delete();
        return redirect(route('admin.user.index'))->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete users')) {
            return view('backend.inc.auth');
        }
        $objs = User::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            $obj->delete();
        }
        return redirect(route('admin.user.index'))->with('success', 'Success! Record has been deleted');
    }
}
