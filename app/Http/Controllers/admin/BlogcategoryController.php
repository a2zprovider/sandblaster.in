<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogcategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view blogcategory')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Blogcategory::select('*');
            if (request()->has('trash')) {
                $data = $data->onlyTrashed();
            }
            if (auth()->user()->role != 'admin') {
                $data = $data->whereIn('author', [auth()->user()->name, 'admin']);
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (request()->has('trash')) {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.blogcategory.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.blogcategory.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.blogcategory.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add blogcategory')) {
            return view('backend.inc.auth');
        }
        $categories = Blogcategory::get();
        $categoryArr  = ['' => 'Select parent category'];
        if (!$categories->isEmpty()) {
            foreach ($categories as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('categoryArr');
        return view('backend.inc.blogcategory.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
			'slug'  => 'unique:blogcategories'
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Blogcategory;
        $input            = $request->except('_token');

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);
		
        $exists = Blogcategory::where('slug',$input['slug'])->count();
        if($exists){
            return redirect()->back()->with('error', 'Error! Slug is already exists.');
        }		
		
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $record->id;
                $history->title     = $record->title;
                $history->message   = 'Blog Category Added';
                $history->save();
            }
            return redirect(route('admin.blogcategory.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.blogcategory.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Blogcategory $blogcategory)
    {
        //
    }

    public function edit(Request $request, Blogcategory $blogcategory)
    {
        if (!$this->checkPermisssion('edit blogcategory')) {
            return view('backend.inc.auth');
        }
        $editData =  $blogcategory->toArray();
        $request->replace($editData);
        $request->flash();


        $categories = Blogcategory::get();
        $categoryArr  = ['' => 'Select parent category'];
        if (!$categories->isEmpty()) {
            foreach ($categories as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('blogcategory', 'categoryArr');
        return view('backend.inc.blogcategory.edit', $data);
    }

    public function update(Request $request, Blogcategory $blogcategory)
    {
        $rules = [
            'title'  => 'required|string',
            'slug'  => 'required|string|unique:blogcategories,slug,'.$blogcategory->id
        ];

        $messages = [
            'title'  => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);
		
        $record     = $blogcategory;
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
                $history->message   = 'Blog Category Edited';
                $history->save();
            }
            return redirect(route('admin.blogcategory.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($blogcategory)
    {
        $blogcategory = Blogcategory::withTrashed()->find($blogcategory);
        $blogcategory->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($blogcategory)
    {
        if (!$this->checkPermisssion('delete blogcategory')) {
            return view('backend.inc.auth');
        }
        $blogcategory = Blogcategory::withTrashed()->find($blogcategory);
        if (auth()->user()->role = 'user') {
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $blogcategory->id;
            $history->title     = $blogcategory->title;
            $history->message   = 'Blog Category Deleted';
            $history->save();
        }
        if ($blogcategory->deleted_at) {
            $blogcategory->forceDelete();
        } else {
            $blogcategory->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete blogcategory')) {
            return view('backend.inc.auth');
        }
        $objs = Blogcategory::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $obj->id;
                $history->title     = $obj->title;
                $history->message   = 'Blog Category Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.blogcategory.index'))->with('success', 'Success! Record has been deleted');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/blogcategory/';
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
        $path = public_path() . '/images/blogcategory/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
