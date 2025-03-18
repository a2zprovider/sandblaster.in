<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view tags')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Tag::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.tag.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.tag.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.tag.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$this->checkPermisssion('add tags')) {
            return view('backend.inc.auth');
        }
        return view('backend.inc.tag.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
			'slug'  => 'unique:tags'
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record           = new Tag;
        $input            = $request->except('_token');

        $input['slug']    = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);
		
        $exists = Tag::where('slug',$input['slug'])->count();
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
                $history->message   = 'Tag Added';
                $history->save();
            }
            return redirect(route('admin.tag.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.tag.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Tag $tag)
    {
        //
    }

    public function edit(Request $request, Tag $tag)
    {
        if (!$this->checkPermisssion('edit tags')) {
            return view('backend.inc.auth');
        }
        $editData =  $tag->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('tag');
        return view('backend.inc.tag.edit', $data);
    }

    public function update(Request $request, Tag $tag)
    {
        $rules = [
            'title'  => 'required|string',
            'slug'  => 'required|string|unique:tags,slug,'.$tag->id
        ];

        $messages = [
            'title'  => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);
		
        $record     = $tag;
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
                $history->message   = 'Tag Edited';
                $history->save();
            }
            return redirect(route('admin.tag.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($tag)
    {
        $tag = Tag::withTrashed()->find($tag);
        $tag->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($tag)
    {
        if (!$this->checkPermisssion('delete tags')) {
            return view('backend.inc.auth');
        }

        $tag = Tag::withTrashed()->find($tag);
        if (auth()->user()->role = 'user') {
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $tag->id;
            $history->title     = $tag->title;
            $history->message   = 'Tag Deleted';
            $history->save();
        }
        if ($tag->deleted_at) {
            $tag->forceDelete();
        } else {
            $tag->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete tags')) {
            return view('backend.inc.auth');
        }
        $objs = Tag::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            $obj->delete();
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $obj->id;
                $history->title     = $obj->title;
                $history->message   = 'Tag Deleted';
                $history->save();
            }
        }
        return redirect(route('admin.tag.index'))->with('success', 'Success! Record has been deleted');
    }
}
