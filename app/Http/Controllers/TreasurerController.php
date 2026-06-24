<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TreasurerController extends Controller
{
    public function treasurer_dashboard(Request $request)
    {
        $paid = Collection::where('payment_status', 'Paid')->count();
        $unpaid = Collection::where('payment_status', 'Unpaid')->count();
        $total_collection = Collection::count();
        $total_amount = Collection::sum('payment_amount');

        $monthYear = $request->query('month');

        $query = Collection::query();

        if ($monthYear) {
            $date = Carbon::createFromFormat('Y-m', $monthYear);

            $query->whereYear('payment_date', $date->year)
                ->whereMonth('payment_date', $date->month);
        }

        $brgy_certification = (clone $query)
            ->where('collection_type', 'Barangay Certification')
            ->sum('payment_amount');

        $brgy_clearance = (clone $query)
            ->where('collection_type', 'Barangay Clearance')
            ->sum('payment_amount');

        $summon = (clone $query)
            ->where('collection_type', 'Summon')
            ->sum('payment_amount');

        $brgy_id = (clone $query)
            ->where('collection_type', 'Barangay ID')
            ->sum('payment_amount');

        $business_clearance = (clone $query)
            ->where('collection_type', 'Business Clearance')
            ->sum('payment_amount');

        return view(
            'treasurer.views.treasurer_dashboard',
            compact(
                'paid',
                'unpaid',
                'total_collection',
                'total_amount',
                'brgy_certification',
                'brgy_clearance',
                'summon',
                'brgy_id',
                'business_clearance'
            )
        );
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

    public function overallreport(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Collection::query()
            ->when($monthYear, function ($query) use ($monthYear) {
                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);
                $query->whereYear('payment_date', $date->year)
                    ->whereMonth('payment_date', $date->month);
            })
            ->get();

        return view('treasurer.report.overallreport', compact('data'));
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
        $query = Collection::where("collection_type", $type)->where('payment_status', $status);

        if ($request->filled('dateFrom')) {
            $query->whereDate('payment_date', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('payment_date', '<=', $request->dateTo);
        }

        $data = $query->get();

        return response()->json(['data' => $data]);
    }
    public function deleteCollection(Request $request)
    {
        $data = Collection::where('collection_id', $request->collection_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Barangay Clearance deleted successfully!']);
    }

    public function get_dashboard_treasurer_table(Request $request)
    {
        $query = Collection::query();

        if ($request->filled('dateFrom')) {
            $query->whereDate('payment_date', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('payment_date', '<=', $request->dateTo);
        }

        $data = $query->get();

        return response()->json(['data' => $data]);
    }

    public function getChartStatisticsCollection(Request $request)
    {
        $type = $request->type;
        $year = $request->year ?? now()->year;

        $months = collect(range(1, 12));

        $query = Collection::query()
            ->whereYear('payment_date', $year);

        if (!empty($type) && $type != 'all') {
            $query->where('collection_type', $type);
        }

        $records = $query
            ->selectRaw('MONTH(payment_date) as month, COUNT(*) as total')
            ->groupBy(DB::raw('MONTH(payment_date)'))
            ->pluck('total', 'month');

        $data = [];

        foreach ($months as $month) {
            $data[] = $records[$month] ?? 0;
        }

        return response()->json($data);
    }
}
