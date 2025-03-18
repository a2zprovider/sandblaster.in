<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Inquery;
use App\Models\UserHistory;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Str;

class InquiryController extends Controller
{
    public function index(Request $request)
    {
        if (!$this->checkPermisssion('inquiry')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Inquery::select('*');
            if (request()->has('trash')) {
                $data = $data->onlyTrashed();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (request()->has('trash')) {
                        $btn = '<a class="edit btn btn-primary btn-sm" href="' . route('admin.inquiry.restore', $row->id) . '"> <i class="fas fa-trash-restore-alt"></i> Restore</a> <a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    } else {
                        $btn = '<a href="#" class="delete btn btn-danger btn-sm" onclick="handelDelete(' . $row->id . ');return false;"><i class="fas fa-trash"></i></a>';
                    }
                    return $btn;
                })
                ->addColumn('date', function ($row) {
                    $date = $row->created_at;
                    return $date;
                })
                ->rawColumns(['date', 'action'])
                ->make(true);
        }

        return view('backend.inc.inquiry.index');
    }

    public function dashboard(Request $request)
    {
        if (!$this->checkPermisssion('inquiry')) {
            return view('backend.inc.auth');
        }
        if ($request->ajax()) {
            $data = Inquery::select('*')->latest()->where('created_at', '>=', Carbon::now()->subDay());
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $date = $row->created_at;
                    return $date;
                })
                ->rawColumns(['date'])
                ->make(true);
        }

        return view('backend.inc.inquiry.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Inquery $inquiry)
    {
        //
    }

    public function edit(Request $request, Inquery $inquiry)
    {
        //
    }

    public function update(Request $request, Inquery $inquiry)
    {
        //
    }

    public function restore($inquiry)
    {
        $inquiry = Inquery::withTrashed()->find($inquiry);
        $inquiry->restore();

        return redirect()->back()->with('success', 'Success! Record has been restored');
    }

    public function destroy($inquiry)
    {
        $inquiry = Inquery::withTrashed()->find($inquiry);
        if (auth()->user()->role = 'user') {
            $history            = new UserHistory;
            $history->user_id   = auth()->user()->id;
            $history->user_name = auth()->user()->name;
            $history->page_id   = $inquiry->id;
            $history->title     = $inquiry->name;
            $history->message   = 'Inquery Deleted';
            $history->save();
        }
        if ($inquiry->deleted_at) {
            $inquiry->forceDelete();
        } else {
            $inquiry->delete();
        }
        return redirect()->back()->with('success', 'Success! Record has been deleted');
    }

    public function deleteAll(Request $request)
    {
        $inquiries = Inquery::whereIn('id', $request->ids_arr)->get();
        foreach ($inquiries as $key => $inq) {
            if (auth()->user()->role = 'user') {
                $history            = new UserHistory;
                $history->user_id   = auth()->user()->id;
                $history->user_name = auth()->user()->name;
                $history->page_id   = $inq->id;
                $history->title     = $inq->name;
                $history->message   = 'Inquery Deleted';
                $history->save();
            }
            $inq->delete();
        }
        return redirect(route('admin.inquiry.index'))->with('success', 'Success! Record has been deleted');
    }
}
