<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Productfilter;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view category')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Category::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.category.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.category.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->addColumn('filters', function ($row) {
                    if (@$row->filter && @$row->filter != null && @$row->filter != '') {
                        $row->filter = explode(',', $row->filter);
                    } else {
                        $row->filter = [];
                    }
                    $pros = Productfilter::whereIn('id', $row->filter)->get();
                    $ta = [];
                    foreach ($pros as $key => $pro) {
                        $ta[] = $pro ? $pro->title : '';
                    }
                    $ta = implode(', ', $ta);
                    return $ta;
                })
                ->rawColumns(['action', 'filters'])
                ->make(true);
        }

        return view('backend.inc.category.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add category')) {
            return view('backend.inc.auth');
        }
        $categories = Category::get();
        $categoryArr = ['' => 'Select parent category'];
        if (!$categories->isEmpty()) {
            foreach ($categories as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $filters = Productfilter::whereNull('parent')->get();
        $filterArr = [];
        if (!$filters->isEmpty()) {
            foreach ($filters as $pcat) {
                $filterArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('categoryArr', 'filterArr');
        return view('backend.inc.category.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'unique:categories'
        ];

        $messages = [
            'title' => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record = new Category;
        $input = $request->except('_token');

        if (@$input['filter'] && @$input['filter'] != null) {
            $input['filter'] = implode(',', $input['filter']);
        }

        $input['slug'] = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);

        $exists = Category::where('slug', $input['slug'])->count();
        if ($exists) {
            return redirect()->back()->with('error', 'Error! Slug is already exists.');
        }

        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history = new UserHistory;
                $history->user_id = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id = $record->id;
                $history->title = $record->title;
                $history->message = 'Category Added';
                $history->save();
            }
            return redirect(route('admin.category.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.category.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Request $request, Category $category)
    {
        if (!$this->checkPermisssion('edit category')) {
            return view('backend.inc.auth');
        }

        if (@$category->filter && @$category->filter != null) {
            $category->filter = explode(',', $category->filter);
        }

        $editData = $category->toArray();
        $request->replace($editData);
        $request->flash();


        $categories = Category::get();
        $categoryArr = ['' => 'Select parent category'];
        if (!$categories->isEmpty()) {
            foreach ($categories as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $filters = Productfilter::whereNull('parent')->get();
        $filterArr = [];
        if (!$filters->isEmpty()) {
            foreach ($filters as $pcat) {
                $filterArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('category', 'categoryArr', 'filterArr');
        return view('backend.inc.category.edit', $data);
    }

    public function update(Request $request, Category $category)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'required|string|unique:categories,slug,' . $category->id
        ];

        $messages = [
            'title' => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);

        $record = $category;
        $input = $request->except('_token', '_method');

        if (@$input['filter'] && @$input['filter'] != null) {
            $input['filter'] = implode(',', $input['filter']);
        } else {
            $input['filter'] = '';
        }

        $input['slug'] = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        if (auth()->user()->role != 'admin') {
            $input['author'] = auth()->user()->name;
        }
        $record->fill($input);
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history = new UserHistory;
                $history->user_id = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id = $record->id;
                $history->title = $record->title;
                $history->message = 'Category Edited';
                $history->save();
            }
            return redirect(route('admin.category.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($category)
    {
        $category = Category::withTrashed()->find($category);
        $category->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($category)
    {
        if (!$this->checkPermisssion('delete category')) {
            return view('backend.inc.auth');
        }
        $category = Category::withTrashed()->find($category);
        if (auth()->user()->role = 'user') {
            $history = new UserHistory;
            $history->user_id = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id = $category->id;
            $history->title = $category->title;
            $history->message = 'Category Deleted';
            $history->save();
        }
        if ($category->deleted_at) {
            $category->forceDelete();
        } else {
            $category->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete category')) {
            return view('backend.inc.auth');
        }
        $objs = Category::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role = 'user') {
                $history = new UserHistory;
                $history->user_id = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id = $obj->id;
                $history->title = $obj->title;
                $history->message = 'Category Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.category.index'))->with('success', 'Success! Record has been deleted');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/category/';
            if (!file_exists($optimizePath)) {
                mkdir($optimizePath, 0755, true);
            }
            $name = time() . '.' . $file->extension();
            $optimizeImage->save($optimizePath . $name, 72);
        }

        return response()->json(['success' => $name]);
    }

    public function image_delete(Request $request)
    {
        $filename = $request->get('filename');
        $path = public_path() . '/images/category/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
