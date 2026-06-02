<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\KagawadRecord;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function admin_dashboard()
    {
        $total_resolved = KagawadRecord::where('record_type', 'blotter')->where('status', 'Resolved')->count();
        $total_unresolved = KagawadRecord::where('record_type', 'blotter')->where('status', 'Unresolved')->count();
        $total_returned = KagawadRecord::where('record_type', 'borrowed')->where('status', 'Returned')->count();
        $total_unreturned = KagawadRecord::where('record_type', 'borrowed')->where('status', 'Unreturned')->count();

        $blotter = KagawadRecord::where('record_type', 'blotter')
            ->selectRaw("
                SUM(CASE WHEN status = 'Resolved' THEN 1 ELSE 0 END) as resolved,
                SUM(CASE WHEN status = 'Unresolved' THEN 1 ELSE 0 END) as unresolved
            ")
            ->first();

        // BORROWED: Returned vs Unreturned
        $borrowed = KagawadRecord::where('record_type', 'borrowed')
            ->selectRaw("
            SUM(CASE WHEN date_of_return IS NOT NULL THEN 1 ELSE 0 END) as returned,
            SUM(CASE WHEN date_of_return IS NULL THEN 1 ELSE 0 END) as unreturned
        ")
            ->first();

        return view('admin.views.admin_dashboard', compact('total_resolved', 'total_unresolved', 'total_returned', 'total_unreturned', 'blotter', 'borrowed'));
    }

    public function secretary_select()
    {
        return view("admin.views.secretary_select");
    }
    public function treasurer_select()
    {
        return view("admin.views.treasurer_select");
    }
    public function kagawad_select()
    {
        return view("admin.views.kagawad_select");
    }
    public function user()
    {
        return view("admin.views.user");
    }
    public function get_users(Request $request)
    {
        $data = User::all();

        return response()->json(['data' => $data]);
    }

    public function storeUser(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        if ($data['id'] != 0 && $data['id'] != "") {
            $user = User::query()->where('username', '=', $data['username'])->first();
            
            if ($user && $user->id != $data['id']) {
                return response()->json(['status' => 'error', 'message' => 'Username already exist!']);
            }

            User::query()
                ->where('id', '=', $data['id'])
                ->update($data);
        } else {
            $user = User::query()->where('username', '=', $data['username'])->first();
            if ($user) {
                return response()->json(['status' => 'error', 'message' => 'Username already exist!']);
            }

            User::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Saved successfully!']);
    }

    public function deleteUser(Request $request)
    {
        $id = $request->id;

        User::query()->where('id', '=', $id)->delete();
        return response()->json(['status' => 'success', 'message' => 'Deleted successfully!']);
    }
}
