<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Productfilter;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductfilterController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view productfilter')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Productfilter::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.productfilter.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.productfilter.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->addColumn('parent', function ($row) {
                    $pro = Productfilter::find($row->parent);
                    $cat = $pro ? $pro->title : '';
                    return $cat;
                })
                ->rawColumns(['action', 'parent'])
                ->make(true);
        }

        return view('backend.inc.productfilter.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add productfilter')) {
            return view('backend.inc.auth');
        }
        $productfilters = Productfilter::whereNull('parent')->get();
        $productfilterArr = ['' => 'Select parent productfilter'];
        if (!$productfilters->isEmpty()) {
            foreach ($productfilters as $pcat) {
                $productfilterArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('productfilterArr');
        return view('backend.inc.productfilter.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'unique:productfilters'
        ];

        $messages = [
            'title' => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record = new Productfilter;
        $input = $request->except('_token');

        $input['slug'] = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);

        $exists = Productfilter::where('slug', $input['slug'])->count();
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
                $history->message = 'Productfilter Added';
                $history->save();
            }
            return redirect(route('admin.productfilter.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.productfilter.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Productfilter $productfilter)
    {
        //
    }

    public function edit(Request $request, Productfilter $productfilter)
    {
        if (!$this->checkPermisssion('edit productfilter')) {
            return view('backend.inc.auth');
        }
        $editData = $productfilter->toArray();
        $request->replace($editData);
        $request->flash();


        $productfilters = Productfilter::whereNotIn('id', [$productfilter->id])->whereNull('parent')->get();
        $productfilterArr = ['' => 'Select parent productfilter'];
        if (!$productfilters->isEmpty()) {
            foreach ($productfilters as $pcat) {
                $productfilterArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('productfilter', 'productfilterArr');
        return view('backend.inc.productfilter.edit', $data);
    }

    public function update(Request $request, Productfilter $productfilter)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'required|string|unique:productfilters,slug,' . $productfilter->id
        ];

        $messages = [
            'title' => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);

        $record = $productfilter;
        $input = $request->except('_token', '_method');

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
                $history->message = 'Productfilter Edited';
                $history->save();
            }
            return redirect(route('admin.productfilter.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($productfilter)
    {
        $productfilter = Productfilter::withTrashed()->find($productfilter);
        $productfilter->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($productfilter)
    {
        if (!$this->checkPermisssion('delete productfilter')) {
            return view('backend.inc.auth');
        }
        $productfilter = Productfilter::withTrashed()->find($productfilter);
        if (auth()->user()->role = 'user') {
            $history = new UserHistory;
            $history->user_id = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id = $productfilter->id;
            $history->title = $productfilter->title;
            $history->message = 'Productfilter Deleted';
            $history->save();
        }
        if ($productfilter->deleted_at) {
            $productfilter->forceDelete();
        } else {
            $productfilter->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete productfilter')) {
            return view('backend.inc.auth');
        }
        $objs = Productfilter::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role = 'user') {
                $history = new UserHistory;
                $history->user_id = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id = $obj->id;
                $history->title = $obj->title;
                $history->message = 'Productfilter Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.productfilter.index'))->with('success', 'Success! Record has been deleted');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/productfilter/';
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
        $path = public_path() . '/images/productfilter/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
