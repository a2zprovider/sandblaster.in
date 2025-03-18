<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Blogcategory;
use App\Models\Category;
use App\Models\Page;
use App\Models\Post;
use App\Models\Tag;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view blogs')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Post::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.blog.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.blog.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->addColumn('category', function ($row) {
                    if (@$row->category_id && @$row->category_id != null && @$row->category_id != '') {
                        $row->category_id = explode(',', $row->category_id);
                    } else {
                        $row->category_id = [];
                    }
                    $pros = Blogcategory::whereIn('id', $row->category_id)->get();
                    $cat = [];
                    foreach ($pros as $key => $pro) {
                        $cat[] = $pro ? $pro->title : '';
                    }
                    $cat = implode(', ', $cat);
                    return $cat;
                })
                ->addColumn('tag', function ($row) {
                    if (@$row->tags && @$row->tags != null && @$row->tags != '') {
                        $row->tags = explode(',', $row->tags);
                    } else {
                        $row->tags = [];
                    }
                    $pros = Tag::whereIn('id', $row->tags)->get();
                    $ta = [];
                    foreach ($pros as $key => $pro) {
                        $ta[] = $pro ? $pro->title : '';
                    }
                    $ta = implode(', ', $ta);
                    return $ta;
                })
                ->rawColumns(['action', 'category', 'tag'])
                ->make(true);
        }

        return view('backend.inc.blog.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add blogs')) {
            return view('backend.inc.auth');
        }
        $category = Blogcategory::get();
        $categoryArr  = [];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }
        $tags = Tag::get();
        $tagArr  = [];
        if (!$tags->isEmpty()) {
            foreach ($tags as $tag) {
                $tagArr[$tag->id] = $tag->title;
            }
        }
        $product = Page::get();
        $productArr  = ['home' => 'Home'];
        if (!$product->isEmpty()) {
            foreach ($product as $p) {
                $productArr[$p->id] = $p->title;
            }
        }

        $data = compact('tagArr', 'categoryArr', 'productArr');
        return view('backend.inc.blog.add', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
            'image'  => 'required',
			'slug'  => 'unique:posts'
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Post;
        $input            = $request->except('_token');

        if (@$input['category_id'] && @$input['category_id'] != null) {
            $input['category_id'] = implode(',', $input['category_id']);
        }
        if (@$input['tags'] && @$input['tags'] != null) {
            $input['tags'] = implode(',', $input['tags']);
        }
        if (@$input['product_id'] && @$input['product_id'] != null) {
            $input['product_id'] = implode(',', $input['product_id']);
        }

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);
		
        $exists = Post::where('slug',$input['slug'])->count();
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
                $history->message   = 'Blog Added';
                $history->save();
            }
            return redirect(route('admin.blog.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.blog.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Post $page)
    {
        //
    }

    public function edit(Request $request, Post $blog)
    {
        if (!$this->checkPermisssion('edit blogs')) {
            return view('backend.inc.auth');
        }
        if (@$blog->category_id && @$blog->category_id != null) {
            $blog->category_id = explode(',', $blog->category_id);
        }
        if (@$blog->tags && @$blog->tags != null) {
            $blog->tags = explode(',', $blog->tags);
        }
        if (@$blog->product_id && @$blog->product_id != null) {
            $blog->product_id = explode(',', $blog->product_id);
        }

        $page = $blog;
        $editData =  $blog->toArray();
        $request->replace($editData);
        $request->flash();

        $category = Blogcategory::get();
        $categoryArr  = [];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }
        $tags = Tag::get();
        $tagArr  = [];
        if (!$tags->isEmpty()) {
            foreach ($tags as $tag) {
                $tagArr[$tag->id] = $tag->title;
            }
        }
        $product = Page::get();
        $productArr  = ['home' => 'Home'];
        if (!$product->isEmpty()) {
            foreach ($product as $p) {
                $productArr[$p->id] = $p->title;
            }
        }

        $data = compact('blog', 'tagArr', 'categoryArr', 'productArr');
        return view('backend.inc.blog.edit', $data);
    }

    public function update(Request $request, Post $blog)
    {
        $rules = [
            'title'  => 'required|string',
            'slug'  => 'required|string|unique:posts,slug,'.$blog->id
        ];

        $messages = [
            'title'  => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);
		
        $record     = $blog;
        $input      = $request->except('_token', '_method');

        if (@$input['category_id'] && @$input['category_id'] != null) {
            $input['category_id'] = implode(',', $input['category_id']);
        } else {
            $input['category_id'] = '';
        }
        if (@$input['tags'] && @$input['tags'] != null) {
            $input['tags'] = implode(',', $input['tags']);
        } else {
            $input['tags'] = '';
        }
        if (@$input['product_id'] && @$input['product_id'] != null) {
            $input['product_id'] = implode(',', $input['product_id']);
        } else {
            $input['product_id'] = '';
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
                $history->message   = 'Blog Edited';
                $history->save();
            }
            return redirect(route('admin.blog.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($blog)
    {
        $blog = Post::withTrashed()->find($blog);
        $blog->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($blog)
    {
        if (!$this->checkPermisssion('delete blogs')) {
            return view('backend.inc.auth');
        }
        $blog = Post::withTrashed()->find($blog);
        if (auth()->user()->role == 'user') {
            foreach ($blog->permission as $key => $value) {
                if ($value->id == auth()->user()->id) {
                    if ($value->pivot->s_delete == 'no') {
                        return view('backend.inc.auth');
                    }
                }
            }
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $blog->id;
            $history->title     = $blog->title;
            $history->message   = 'Blog Deleted';
            $history->save();
        }
        if ($blog->deleted_at) {
            $blog->forceDelete();
        } else {
            $blog->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete blogs')) {
            return view('backend.inc.auth');
        }
        $objs = Post::whereIn('id', $request->ids_arr)->get();
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
                $history->message   = 'Blog Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.blog.index'))->with('success', 'Success! Record has been deleted');
    }


    public function meta_index(Request $request)
    {
        if (!$this->checkPermisssion('view blogs')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Post::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.meta.blog.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.meta.blog.index');
    }

    public function meta_edit(Request $request, Post $blog)
    {
        if (!$this->checkPermisssion('edit blogs')) {
            return view('backend.inc.auth');
        }
        $page = $blog;
        $editData =  $blog->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('blog');
        return view('backend.inc.meta.blog.edit', $data);
    }

    public function meta_update(Request $request, Post $blog)
    {
        $record     = $blog;
        $input      = $request->except('_token', '_method');

        $record->fill($input);
        if ($record->save()) {
            return redirect(route('admin.meta.blog.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function permission(Request $request)
    {
        $n_peoducts = [];
        $blogs = Post::select('id', 'title')->whereIn('id', $request->ids)->get();
        foreach ($blogs as $key => $value) {
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
            $blog = Post::find($id);
            $p = [$request->user_id];
            $per = [];
            if (@$request->permission[$id]) {
                foreach (@$request->permission[$id] as $key => $value) {
                    $per['s_' . $value] = 'yes';
                }
            }
            $blog->permission()->detach($request->user_id);
            $blog->permission()->attach($request->user_id, $per);
        }

        return redirect(route('admin.blog.index'))->with('success', 'Success! Permission has been edited');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/blog/';
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
        $path = public_path() . '/images/blog/' . $filename;
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
            $optimizePath = public_path() . '/images/blog/';
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
        $path = public_path() . '/images/blog/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
