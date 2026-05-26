<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TreasurerController extends Controller
{
    public function treasurer_dashboard()
    {
        return view('treasurer.views.treasurer_dashboard');
    }

    public function collectionfee_select()
    {
        return view('treasurer.views.collectionfee_select');
    }

    public function barangay_clearance()
    {
        return view('treasurer.views.barangay_clearance');
    }

    public function barangay_certification()
    {
        return view('treasurer.views.barangay_certification');
    }
    public function summon()
    {
        return view('treasurer.views.summon');
    }
    public function barangay_id()
    {
        return view('treasurer.views.barangay_id');
    }
    public function business_clearance()
    {
        return view('treasurer.views.business_clearance');
    }
    public function storeCollection(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($data['collection_id'] != 0 && $data['collection_id'] != "") {
            Collection::where("collection_id", $data['collection_id'])->update($data);
        } else {
            Collection::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Barangay Clearance saved successfully!']);
    }
    public function get_collection(Request $request)
    {
        $type = $request->type;
        $status = $request->status;
        $data = Collection::where("collection_type", $type)->where('payment_status', $status)->get();

        return response()->json(['data' => $data]);
    }
    public function deleteCollection(Request $request)
    {
        $data = Collection::where('collection_id', $request->collection_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Barangay Clearance deleted successfully!']);
    }
}
