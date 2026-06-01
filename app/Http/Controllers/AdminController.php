<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\KagawadRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
}
