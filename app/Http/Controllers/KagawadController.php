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
        $paid = Collection::where('payment_status', 'Paid')->count();
        $unpaid = Collection::where('payment_status', 'Unpaid')->count();
        $total_collection = Collection::count();
        $total_amount = Collection::sum('payment_amount');

        return view('kagawad.views.kagawad_dashboard', compact('paid', 'unpaid', 'total_collection', 'total_amount'));
    }

    public function blotter()
    {
        return view('kagawad.views.blotter');
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
}
