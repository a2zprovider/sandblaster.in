<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Productfilter;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view client')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Client::select('*');
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
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.client.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.client.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.client.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add client')) {
            return view('backend.inc.auth');
        }

        return view('backend.inc.client.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'unique:clients'
        ];

        $messages = [
            'title' => 'Please Enter Name.',
        ];

        $request->validate($rules, $messages);

        $record = new Client;
        $input = $request->except('_token');

        $input['slug'] = $input['slug'] == '' ? Str::slug($input['title'], '-') : Str::slug($input['slug'], '-');
        $input['author'] = auth()->user()->name;
        $record->fill($input);

        $exists = Client::where('slug', $input['slug'])->count();
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
                $history->message = 'Client Added';
                $history->save();
            }
            return redirect(route('admin.client.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.client.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Request $request, Client $client)
    {
        if (!$this->checkPermisssion('edit client')) {
            return view('backend.inc.auth');
        }

        $editData = $client->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('client');
        return view('backend.inc.client.edit', $data);
    }

    public function update(Request $request, Client $client)
    {
        $rules = [
            'title' => 'required|string',
            'slug' => 'required|string|unique:clients,slug,' . $client->id
        ];

        $messages = [
            'title' => 'Please Enter title.',
        ];

        $request->validate($rules, $messages);

        $record = $client;
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
                $history->message = 'Client Edited';
                $history->save();
            }
            return redirect(route('admin.client.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function restore($client)
    {
        $client = Client::withTrashed()->find($client);
        $client->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($client)
    {
        if (!$this->checkPermisssion('delete client')) {
            return view('backend.inc.auth');
        }
        $client = Client::withTrashed()->find($client);
        if (auth()->user()->role = 'user') {
            $history = new UserHistory;
            $history->user_id = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id = $client->id;
            $history->title = $client->title;
            $history->message = 'Client Deleted';
            $history->save();
        }
        if ($client->deleted_at) {
            $client->forceDelete();
        } else {
            $client->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete client')) {
            return view('backend.inc.auth');
        }
        $objs = Client::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            if (auth()->user()->role = 'user') {
                $history = new UserHistory;
                $history->user_id = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id = $obj->id;
                $history->title = $obj->title;
                $history->message = 'Client Deleted';
                $history->save();
            }
            $obj->delete();
        }
        return redirect(route('admin.client.index'))->with('success', 'Success! Record has been deleted');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/client/';
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
        $path = public_path() . '/images/client/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
