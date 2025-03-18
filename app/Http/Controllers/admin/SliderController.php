<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('view slider')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Slider::select('*');
            if (auth()->user()->role != 'admin') {
                $data = Slider::select('*')->whereIn('author', [auth()->user()->name, 'admin']);
            }
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.slider.edit', $row->id) . '"> <i class="fas fa-edit"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('backend.inc.slider.index');
    }

    public function create()
    {
        if (!$this->checkPermisssion('add slider')) {
            return view('backend.inc.auth');
        }
        return view('backend.inc.slider.add');
    }

    public function store(Request $request)
    {
        $rules = [
            'title'  => 'required|string',
            'image'  => 'required',
        ];

        $messages = [
            'title'  => 'Please Enter Name.',
            'image'  => 'Please Select Image'
        ];

        $request->validate($rules, $messages);

        $record           = new Slider;
        $input            = $request->except('_token');
        $input['author'] = auth()->user()->name;
        $record->fill($input);
        if ($record->save()) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $record->id;
                $history->title     = $record->title;
                $history->message   = 'Slider Added';
                $history->save();
            }
            return redirect(route('admin.slider.index'))->with('success', 'Success! New record has been added.');
        } else {
            return redirect(route('admin.slider.index'))->with('danger', 'Error! Something going wrong.');
        }
    }

    public function show(Slider $slider)
    {
        //
    }

    public function edit(Request $request, Slider $slider)
    {
        if (!$this->checkPermisssion('edit slider')) {
            return view('backend.inc.auth');
        }
        $editData =  $slider->toArray();
        $request->replace($editData);
        $request->flash();

        $data = compact('slider');
        return view('backend.inc.slider.edit', $data);
    }

    public function update(Request $request, Slider $slider)
    {
        $rules = [
            'title'  => 'required|string',
            'image'  => 'required',
        ];
        $messages = [
            'title'  => 'Please Enter Name.',
            'image'  => 'Please Select Image'
        ];
        $request->validate($rules, $messages);

        $record     = $slider;
        $input      = $request->except('_token', '_method');
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
                $history->message   = 'Slider Edited';
                $history->save();
            }
            return redirect(route('admin.slider.index'))->with('success', 'Success! Record has been edited');
        }
    }

    public function destroy(Slider $slider)
    {
        if (!$this->checkPermisssion('delete slider')) {
            return view('backend.inc.auth');
        }
        $slider->delete();
        if (auth()->user()->role = 'user') {
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $slider->id;
            $history->title     = $slider->title;
            $history->message   = 'Slider Deleted';
            $history->save();
        }
        return redirect(route('admin.slider.index'))->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        if (!$this->checkPermisssion('delete slider')) {
            return view('backend.inc.auth');
        }
        $objs = Slider::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            $obj->delete();
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $obj->id;
                $history->title     = $obj->title;
                $history->message   = 'Slider Deleted';
                $history->save();
            }
        }
        return redirect(route('admin.slider.index'))->with('success', 'Success! Record has been deleted');
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->image;
            $optimizeImage = Image::make($file);
            $optimizePath = public_path() . '/images/slider/';
            if (!file_exists($optimizePath)) {
                mkdir($optimizePath, 0755, true);
            }
            $name    = time() . '.' . $file->extension();
            $optimizeImage->save($optimizePath . $name, 72);
        }

        return response()->json(['success' => $name]);
    }

    public function image_delete(Request $request)
    {
        $filename =  $request->get('filename');
        $path = public_path() . '/images/slider/' . $filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return $filename;
    }
}
