<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\KagawadRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KagawadController extends Controller
{
    public function kagawad_dashboard()
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

        return view('kagawad.views.kagawad_dashboard', compact('total_resolved', 'total_unresolved', 'total_returned', 'total_unreturned', 'blotter', 'borrowed'));
    }

    public function blotter()
    {
        return view('kagawad.views.blotter');
    }

    public function borrowedequipment()
    {
        return view('kagawad.views.borrowedequipment');
    }

    public function kagawad_select()
    {
        return view('kagawad.views.kagawad_select');
    }

    public function storeKagawadRecord(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($data['record_id'] != 0 && $data['record_id'] != "") {
            KagawadRecord::where("record_id", $data['record_id'])->update($data);
        } else {
            KagawadRecord::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Saved successfully!']);
    }

    public function get_blotter(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        $data = KagawadRecord::where("record_type", $type)->where('status', $status)->get();

        return response()->json(['data' => $data]);
    }

    public function deleteRecord(Request $request)
    {
        $data = KagawadRecord::where('record_id', $request->record_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Record deleted successfully!']);
    }

    public function blotter_report(Request $request)
    {
        $type = $request->query('type');
        $monthYear = $request->query('month');

        $data = KagawadRecord::where('record_type', "blotter")

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);
                $query->whereYear('date_of_complaints', $date->year)
                    ->whereMonth('date_of_complaints', $date->month);
            })
            ->get();


        return view('kagawad.reports.blotter_report', compact('data'));
    }

    public function borrowed_report(Request $request)
    {
        $type = $request->query('type');
        $monthYear = $request->query('month');

        $data = KagawadRecord::where('record_type', "borrowed")

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);
                $query->whereYear('date_of_borrowed', $date->year)
                    ->whereMonth('date_of_borrowed', $date->month);
            })
            ->get();


        return view('kagawad.reports.borrowed_report', compact('data'));
    }
}
