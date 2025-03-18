<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use App\Models\UserHistory;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserHistoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = UserHistory::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('date', function ($row) {
                    $date = $row->created_at;
                    return $date;
                })
                ->rawColumns(['date'])
                ->make(true);
        }

        return view('backend.inc.userhistory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }

    public function edit(Request $request, User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy($userhistory)
    {
        //
    }

    public function deleteAll(Request $request)
    {
        $objs = UserHistory::whereIn('id', $request->ids_arr)->get();
        foreach ($objs as $key => $obj) {
            $obj->delete();
        }
        return redirect(route('admin.user.index'))->with('success', 'Success! Record has been deleted');
    }
}
