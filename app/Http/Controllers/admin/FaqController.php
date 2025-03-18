<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Faq;
use App\Models\Page;
use App\Models\Tag;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class FaqController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view faqs')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Faq::select('*');
            if (request()->has('trash')) {
                $data = $data->onlyTrashed();
            }
            if (auth()->user()->role != 'admin') {
                $data = $data->whereIn('author', [auth()->user()->name, 'admin']);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (request()->has('trash')) {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.faq.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.faq.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->addColumn('product', function ($row) {
                    if (@$row->category_id && @$row->category_id != null && @$row->category_id != '') {
                        $row->category_id = explode(',', $row->category_id);
                    } else {
                        $row->category_id = [];
                    }
                    $cat = [];
                    if (@$row->category_id[0] == 'home') {
                        $cat[] = 'Home';
                    }

                    $pros = Page::whereIn('id', $row->category_id)->get();

                    foreach ($pros as $key => $pro) {
                        $cat[] = $pro ? $pro->title : '';
                    }
                    $cat = implode(', ', $cat);
                    return $cat;
                })
                ->rawColumns(['action', 'product'])
                ->make(true);
        }

        return view('backend.inc.faq.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->checkPermisssion('add faqs')) {
            return view('backend.inc.auth');
        }
        $category = Page::get();
        $categoryArr  = ['home' => 'Home'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }

        $data = compact('categoryArr');
        return view('backend.inc.faq.add', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Faq;
        $input            = $request->except('_token');

        if (@$input['category_id'] && @$input['category_id'] != null) {
            $input['category_id'] = implode(',', $input['category_id']);
        }
        $input['author'] = auth()->user()->name;

        $record->fill($input);
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $record->id;
                $history->title     = $record->title;
                $history->message   = 'Faq Added';
                $history->save();
            }
            return redirect(route('admin.faq.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.faq.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Faq $faq)
    {
        if (!$this->checkPermisssion('edit faqs')) {
            return view('backend.inc.auth');
        }
        if (@$faq->category_id && @$faq->category_id != null) {
            $faq->category_id = explode(',', $faq->category_id);
        }

        $editData =  $faq->toArray();
        $request->replace($editData);
        $request->flash();

        $category = Page::get();
        $categoryArr  = ['home' => 'Home'];
        if (!$category->isEmpty()) {
            foreach ($category as $pcat) {
                $categoryArr[$pcat->id] = $pcat->title;
            }
        }
        $data = compact('faq', 'categoryArr');
        return view('backend.inc.faq.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faq $faq)
    {
        $record     = $faq;
        $input      = $request->except('_token', '_method');

        if (@$input['category_id'] && @$input['category_id'] != null) {
            $input['category_id'] = implode(',', $input['category_id']);
        }

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
                $history->message   = 'Faq Edited';
                $history->save();
            }
            return redirect(route('admin.faq.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($faq)
    {
        $faq = Faq::withTrashed()->find($faq);
        $faq->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($faq)
    {
        if (!$this->checkPermisssion('delete faqs')) {
            return view('backend.inc.auth');
        }
        $faq = Faq::withTrashed()->find($faq);
        if (auth()->user()->role = 'user') {
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $faq->id;
            $history->title     = $faq->title;
            $history->message   = 'Faq Deleted';
            $history->save();
        }
        if ($faq->deleted_at) {
            $faq->forceDelete();
        } else {
            $faq->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete faqs')) {
            return view('backend.inc.auth');
        }
        $objs = Faq::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $obj->id;
                $history->title     = $obj->title;
                $history->message   = 'Faq Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.faq.index'))->with('success', 'Success! Record has been deleted');
    }
}
