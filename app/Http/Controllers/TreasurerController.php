<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TreasurerController extends Controller
{
    public function treasurer_dashboard()
    {
        $paid = Collection::where('payment_status', 'Paid')->count();
        $unpaid = Collection::where('payment_status', 'Unpaid')->count();
        $total_collection = Collection::count();
        $total_amount = Collection::sum('payment_amount');

        return view('treasurer.views.treasurer_dashboard', compact('paid', 'unpaid', 'total_collection', 'total_amount'));
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

    public function collectionfeereport_select(Request $request)
    {
        return view('treasurer.views.collectionfeereport_select');
    }

    public function collection_report(Request $request)
    {
        $type = $request->query('type');
        $monthYear = $request->query('month');

        $data = Collection::where('collection_type', $type)

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('payment_date', $date->year)
                    ->whereMonth('payment_date', $date->month);
            })
            ->get();

        return view('treasurer.report.collection_report', compact('data'));
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

    public function get_dashboard_treasurer_table(Request $request)
    {
        $data = Collection::all();

        return response()->json(['data' => $data]);
    }

    public function getChartStatisticsCollection(Request $request)
    {
        $month = $request->input('month');
        $type = $request->input('type');
        $year = $request->input('year', Carbon::now()->year);

        $certificateMap = [
            'clearance' => 'Barangay Clearance',
            'certification' => 'Barangay Certification',
            'summon' => 'Summon',
            'barangay_id' => 'Barangay ID',
            'businessclearance' => 'Barangay Business Clearance',
        ];


        $query = Collection::query()->whereYear('payment_date', $year);

        if ($month && $month !== 'all') {
            $query->whereMonth('payment_date', $month);
        }
        if (!empty($type) && $type != "all") {
            $query->where('collection_type', $type);
        }

        // Query groups by the short code values stored in your DB
        $results = $query->select('collection_type', DB::raw('COUNT(*) as total'))
            ->groupBy('collection_type')
            ->get();

        $labels = [];
        $series = [];

        // Loop through the map to ensure every single option is represented
        foreach ($certificateMap as $dbValue => $displayLabel) {
            $labels[] = $displayLabel; // Sends the full name straight to the chart labels
            $match = $results->firstWhere('collection_type', $dbValue);
            $series[] = $match ? $match->total : 0;
        }

        return response()->json([
            'labels' => $labels,
            'series' => $series
        ]);
    }
}
