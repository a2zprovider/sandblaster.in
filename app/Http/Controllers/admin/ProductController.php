<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Country;
use App\Models\Page;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view products')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Page::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.product.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.product.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('category', function ($row) {
                    $pro = Category::find($row->category_id);
                    $cat = $pro ? $pro->title : '';
                    return $cat;
                })
                ->rawColumns(['category', 'action', 'author'])
                ->make(true);
        }

        return view('backend.inc.product.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add products')) {
            return view('backend.inc.auth');
        }
        $category = Category::get();
        $categoryArr  = ['' => 'Select category'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('categoryArr');
        return view('backend.inc.product.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
            'image'  => 'required',
			'slug'  => 'unique:pages'
        ];

        $messages = [
            'record.title'  => 'Please Enter Name.',
            'image'  => 'Please Select Image'
        ];

        $request->validate($rules, $messages);

        $record           = new Page;
        $input            = $request->except('_token');

        $input['field'] = $request->field ? json_encode($request->field) : '{"name":[],"value":[]}';
        $input['field1'] = $request->field1 ? json_encode($request->field1) : '{"name":[],"value":[]}';

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $imgs = [];
            foreach ($files as $f) {
                $optimizeImage = Image::make($f);
                $optimizePath = public_path() . '/images/page/imgs/';
                if (!file_exists($optimizePath)) {
                    mkdir($optimizePath, 0755, true);
                }
                $image = explode(".", $f->getClientOriginalName());
                $image_name = $image[0];
                $name = time() . Str::slug($image_name, '-') . '.' . $f->getClientOriginalExtension();
                $optimizeImage->save($optimizePath . $name);
                $imgs[] = $name;
            }
            $input['images'] = json_encode($imgs);
        }

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);
       
		$exists = Page::where('slug',$input['slug'])->count();
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
                $history->message   = 'Product Added';
                $history->save();
            }

            return redirect(route('admin.product.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.product.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Request $request, Page $product)
    {
        if (!$this->checkPermisssion('edit products')) {
            return view('backend.inc.auth');
        }
        if (auth()->user()->role == 'user') {
            foreach ($product->permission as $key => $value) {
                if ($value->id == auth()->user()->id) {
                    if ($value->pivot->s_edit == 'no') {
                        return view('backend.inc.auth');
                    }
                }
            }
        }

        $page = $product;
        $editData =  $product->toArray();
        $request->replace($editData);
        $request->flash();

        $category = Category::get();
        $categoryArr  = ['' => 'Select category'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $images = [];
        if ($product->images) {
            $images = explode(',', $product->images);
        }
        $images_url_arr = [];
        foreach ($images as $key => $img) {
            $path = url('images/product/imgs/' . $img);
            $images_url_arr[] = $path;
        }
        $images_url_arr = implode(',', $images_url_arr);

        $data = compact('page', 'categoryArr', 'images_url_arr');
        return view('backend.inc.product.edit', $data);
    }

    public function update(Request $request, Page $product)
    {
        $rules = [
            'title'  => 'required|string',
            'slug'  => 'required|string|unique:pages,slug,'.$product->id
        ];

        $messages = [
            'title'  => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);
		
        $record     = $product;
        $input      = $request->except('_token', '_method');
        $input['field'] = $request->field ? $request->field : '{"name":[],"value":[]}';
        $input['field1'] = $request->field1 ? $request->field1 : '{"name":[],"value":[]}';

        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $imgs = [];
            foreach (json_decode($product->images) as $key => $v) {
                $imgs[] = $v;
            }
            foreach ($files as $f) {
                $optimizeImage = Image::make($f);
                $optimizePath = public_path() . '/images/page/imgs/';
                if (!file_exists($optimizePath)) {
                    mkdir($optimizePath, 0755, true);
                }
                $image = explode(".", $f->getClientOriginalName());
                $image_name = $image[0];
                $name = time() . Str::slug($image_name, '-') . '.' . $f->getClientOriginalExtension();
                $optimizeImage->save($optimizePath . $name);
                $imgs[] = $name;
            }
            $input['images'] = $imgs;
        }

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
                $history->message   = 'Product Edited';
                $history->save();
            }
            return redirect(route('admin.product.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($product)
    {
        $product = Page::withTrashed()->find($product);
        $product->restore();
        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($product)
    {
        if (!$this->checkPermisssion('delete products')) {
            return view('backend.inc.auth');
        }

        $product = Page::withTrashed()->find($product);
        if (auth()->user()->role == 'user') {
            foreach ($product->permission as $key => $value) {
                if ($value->id == auth()->user()->id) {
                    if ($value->pivot->s_delete == 'no') {
                        return view('backend.inc.auth');
                    }
                }
            }

            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $product->id;
            $history->title     = $product->title;
            $history->message   = 'Product Deleted';
            $history->save();
        }
        if ($product->deleted_at) {
            $product->forceDelete();
        } else {
            $product->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function page_image($page, $key)
    {
        $page = Page::find($page);
        $images = json_decode($page->images);
        unlink('public/images/page/imgs/' . $images[$key]);
        unset($images[$key]);
        $img = [];
        foreach ($images as $key => $value) {
            $img[] = $value;
        }
        $page->images = $img;
        $page->save();
        return redirect()->back()->with('success', 'Success! Image has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete products')) {
            return view('backend.inc.auth');
        }
        $objs = Page::whereIn('id', $request->ids_arr)->get();
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
                $history->message   = 'Product Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.product.index'))->with('success', 'Success! Record has been deleted');
    }

    public function meta_index(Request $request)
    {
        if (!$this->checkPermisssion('view products')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Page::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.meta.product.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('backend.inc.meta.product.index');
    }

    public function meta_edit(Request $request, Page $product)
    {
        if (!$this->checkPermisssion('edit products')) {
            return view('backend.inc.auth');
        }
        $page = $product;
        $editData =  $product->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('page');
        return view('backend.inc.meta.product.edit', $data);
    }

    public function meta_update(Request $request, Page $product)
    {
        $record     = $product;
        $input      = $request->except('_token', '_method');

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.meta.product.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function permission(Request $request)
    {
        $n_peoducts = [];
        $products = Page::select('id', 'title')->whereIn('id', $request->ids)->get();
        foreach ($products as $key => $value) {
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
            $product = Page::find($id);
            $p = [$request->user_id];
            $per = [];
            if (@$request->permission[$id]) {
                foreach (@$request->permission[$id] as $key => $value) {
                    $per['s_' . $value] = 'yes';
                }
            }
            $product->permission()->detach($request->user_id);
            $product->permission()->attach($request->user_id, $per);
        }

        return redirect(route('admin.product.index'))->with('success', 'Success! Permission has been edited');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/product/';
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
        $path = public_path() . '/images/product/' . $filename;
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
            $optimizePath = public_path() . '/images/product/';
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
        $path = public_path() . '/images/product/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function multi_image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/product/imgs/';
            if (!file_exists($optimizePath)) {
                mkdir($optimizePath, 0755, true);
            }
            $name    = time() . '' . rand(10000, 99999) . '.' . $file->extension();
            $optimizeImage->save($optimizePath . $name);
        }

        return response()->json(['success' => $name]);
    }

    public function multi_image_delete(Request $request)
    {
        $filename =  $request->get('filename');
        $path = public_path() . '/images/product/imgs/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }

    public function location(Request $request)
    {
        // $ids = explode(',', $request->ids);
        // foreach ($ids as $key => $id) {
        //     $product = Page::find($id);
        //     // dd($product);
        //     // dd($request->country);
        //     foreach (@$request->country as $key => $country) {
        //         $country = Country::find($country);

        //         $input = [];
        //         $input['title'] = $product->title . ' in ' . $country->name;
        //         $input['slug'] = $product->slug . ' in ' . $country->name;
        //         $input['category_id'] = $product->category_id;
        //         $input['tags'] = $product->tags;
        //         $input['image'] = $product->image;
        //         $input['payment_method'] = $product->payment_method;
        //         $input['transport_mode'] = $product->transport_mode;
        //         $input['price_range'] = $product->price_range;
        //         $input['rating'] = $product->rating;
        //         $input['video'] = $product->video;
        //         $input['images'] = $product->images;
        //         $input['field'] = $product->field;
        //         $input['field1'] = $product->field1;
        //         $input['applications'] = $product->applications;
        //         $input['short_description'] = $product->short_description;
        //         $input['description'] = $product->description;
        //         $input['seo_title'] = $product->seo_title;
        //         $input['seo_keywords'] = $product->seo_keywords;
        //         $input['seo_description'] = $product->seo_description;

        //         $input['slug'] =  Str::slug($input['slug'], '-');

        //         $record = new Page;
        //         $record->fill($input);
        //         $record->save();
        //     }
        // }

        return redirect(route('admin.product.index'));
    }
}
