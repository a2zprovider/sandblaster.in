<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view applications')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Application::select('*');
            if (request()->has('trash')) {
                $data = $data->onlyTrashed();
            }
            if (auth()->user()->role != 'admin') {
                $data = $data->whereHas('permission', function ($q) {
                    $q->where('user_id', auth()->user()->id)->where('s_view', 'yes');
                });
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (request()->has('trash')) {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.application.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.application.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.application.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add applications')) {
            return view('backend.inc.auth');
        }
        return view('backend.inc.application.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
			'slug'  => 'unique:applications'
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Application;
        $input            = $request->except('_token');

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;

        $record->fill($input);
		
        $exists = Application::where('slug',$input['slug'])->count();
        if($exists){
            return redirect()->back()->with('error', 'Error! Slug is already exists.');
        }		
		
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $per = ['s_view' => 'yes', 's_add' => 'yes', 's_edit' => 'yes', 's_delete' => 'yes'];
                $record->permission()->attach(auth()->user()->id, $per);

                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $record->id;
                $history->title     = $record->title;
                $history->message   = 'Application Added';
                $history->save();
            }
            return redirect(route('admin.application.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.application.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Application $application)
    {
        //
    }

    public function edit(Request $request, Application $application)
    {
        if (!$this->checkPermisssion('edit applications')) {
            return view('backend.inc.auth');
        }
        $editData =  $application->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('application');
        return view('backend.inc.application.edit', $data);
    }

    public function update(Request $request, Application $application)
    {
        $rules = [
            'title'  => 'required|string',
            'slug'  => 'required|string|unique:applications,slug,'.$application->id
        ];

        $messages = [
            'title'  => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);
		
        $record     = $application;
        $input      = $request->except('_token', '_method');

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');

        if (auth()->user()->role != 'admin') {
            $input['author'] = auth()->user()->name;
        }

        $record->fill($input);
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $record->id;
                $history->title     = $record->title;
                $history->message   = 'Application Edited';
                $history->save();
            }
            return redirect(route('admin.application.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($application)
    {
        $application = Application::withTrashed()->find($application);
        $application->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($application)
    {
        if (!$this->checkPermisssion('delete applications')) {
            return view('backend.inc.auth');
        }

        $application = Application::withTrashed()->find($application);
        if (auth()->user()->role == 'user') {
            foreach ($application->permission as $key => $value) {
                if ($value->id == auth()->user()->id) {
                    if ($value->pivot->s_delete == 'no') {
                        return view('backend.inc.auth');
                    }
                }
            }
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $application->id;
            $history->title     = $application->title;
            $history->message   = 'Application Deleted';
            $history->save();
        }
        if ($application->deleted_at) {
            $application->forceDelete();
        } else {
            $application->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete applications')) {
            return view('backend.inc.auth');
        }
        $objs = Application::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role == 'user') {
                foreach ($obj->permission as $key => $value) {
                    if ($value->id == auth()->user()->id) {
                        if ($value->pivot->s_delete == 'no') {
                            return view('backend.inc.auth');
                        }
                    }
                }
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $obj->id;
                $history->title     = $obj->title;
                $history->message   = 'Application Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.application.index'))->with('success', 'Success! Record has been deleted');
    }

    public function meta_index(Request $request)
    {
        if (!$this->checkPermisssion('view applications')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Application::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.meta.application.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.meta.application.index');
    }

    public function meta_edit(Request $request, Application $application)
    {
        if (!$this->checkPermisssion('edit applications')) {
            return view('backend.inc.auth');
        }
        $editData =  $application->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('application');
        return view('backend.inc.meta.application.edit', $data);
    }

    public function meta_update(Request $request, Application $application)
    {
        $record     = $application;
        $input      = $request->except('_token', '_method');

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.meta.application.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function permission(Request $request)
    {
        $n_peoducts = [];
        $applications = Application::select('id', 'title')->whereIn('id', $request->ids)->get();
        foreach ($applications as $key => $value) {
            $a = [];
            $a['id'] = $value->id;
            $a['title'] = $value->title;
            $a['permission'] = $value->permission;
            $n_peoducts[] = $a;
        }
        return response()->json(['data' => $n_peoducts]);
    }

    public function author(Request $request)
    {
        $ids = explode(',', $request->ids);
        foreach ($ids as $key => $id) {
            $application = Application::find($id);
            $p = [$request->user_id];
            $per = [];
            if (@$request->permission[$id]) {
                foreach (@$request->permission[$id] as $key => $value) {
                    $per['s_' . $value] = 'yes';
                }
            }
            $application->permission()->detach($request->user_id);
            $application->permission()->attach($request->user_id, $per);
        }

        return redirect(route('admin.application.index'))->with('success', 'Success! Permission has been edited');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/application/';
            if (!file_exists($optimizePath)) {
                mkdir($optimizePath, 0755, true);
            }
            $name    = time() . '.' . $file->extension();
            $optimizeImage->save($optimizePath . $name);
        }

        return response()->json(['success' => $name]);
    }

    public function image_delete(Request $request)
    {
        $filename =  $request->get('filename');
        $path = public_path() . '/images/application/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function thumb_image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/application/';
            if (!file_exists($optimizePath)) {
                mkdir($optimizePath, 0755, true);
            }
            $name    = 'thumb_' . time() . '.' . $file->extension();
            $optimizeImage->save($optimizePath . $name);
        }

        return response()->json(['success' => $name]);
    }

    public function thumb_image_delete(Request $request)
    {
        $filename =  $request->get('filename');
        $path = public_path() . '/images/application/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
