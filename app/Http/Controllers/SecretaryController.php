<?php

namespace App\Http\Controllers;

use App\Models\BrgyID;
use App\Models\Certification;
use App\Models\HouseholdMember;
use App\Models\Quarry;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SecretaryController extends Controller
{
    public function secretary_dashboard(Request $request)
    {
        $resident_count = Resident::count();
        $brgy_id_count = BrgyID::count();
        $certification_count = Certification::count();
        $otp_quaryy_count = Quarry::count();

        return view('secretary.views.secretary_dashboard', compact(
            'resident_count',
            'brgy_id_count',
            'certification_count',
            'otp_quaryy_count'
        ));
    }

    public function certification_select(Request $request)
    {
        return view('secretary.views.certification_select');
    }

    public function report_select(Request $request)
    {
        return view('secretary.views.report_select');
    }
    public function certificate_brgy(Request $request)
    {
        return view('secretary.views.certificate_brgy');
    }

    public function certificate_clearance(Request $request)
    {
        return view('secretary.views.certificate_clearance');
    }

    public function certificate_trees(Request $request)
    {
        return view('secretary.views.certificate_trees');
    }

    public function certificate_jobseeker(Request $request)
    {
        return view('secretary.views.certificate_jobseeker');
    }

    public function certificate_goodmoral(Request $request)
    {
        return view('secretary.views.certificate_goodmoral');
    }

    public function certificate_indigency(Request $request)
    {
        return view('secretary.views.certificate_indigency');
    }

    public function certificate_livestock(Request $request)
    {
        return view('secretary.views.certificate_livestock');
    }
    public function certificate_motorcycle(Request $request)
    {
        return view('secretary.views.certificate_motorcycle');
    }
    public function certificate_piggery(Request $request)
    {
        return view('secretary.views.certificate_piggery');
    }
    public function certificate_quary(Request $request)
    {
        return view('secretary.views.certificate_quary');
    }
    public function certificate_lot(Request $request)
    {
        return view('secretary.views.certificate_lot');
    }
    public function brgy_id(Request $request)
    {
        return view('secretary.views.brgy_id');
    }
    public function rbi(Request $request)
    {
        return view('secretary.views.rbi');
    }
    public function quarry(Request $request)
    {
        return view('secretary.views.quarry');
    }
    public function storeCertification(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        // Handle Image Upload
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/certifications'), $filename);
            $data['image_path'] = $filename;
        }
        if ($data['certification_id'] != 0 || $data['certification_id'] != "") {
            Certification::where("certification_id", $data['certification_id'])->update($data);
        } else {
            Certification::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Certification saved successfully!']);
    }

    public function storeBrgyID(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($data['brgy_id'] != 0 && $data['brgy_id'] != "") {
            BrgyID::where("brgy_id", $data['brgy_id'])->update($data);
        } else {
            BrgyID::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Barangay ID saved successfully!']);
    }

    public function storeQuarry(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($data['quarry_id'] != 0 && $data['quarry_id'] != "") {
            Quarry::where("quarry_id", $data['quarry_id'])->update($data);
        } else {
            Quarry::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'OTP Quarry saved successfully!']);
    }

    public function storeRBI(Request $request)
    {
        $data = $request->all();
        $houseHoldMember = json_decode($request->houseHoldMember, true) ?? [];
        unset($data['_token'], $data['houseHoldMember']);

        if ($data['resident_id'] != 0 && $data['resident_id'] != "") {
            $resident_id = $data['resident_id'];
            Resident::where("resident_id", $data['resident_id'])->update($data);
        } else {
            $resident = Resident::create($data);
            $resident_id = $resident->resident_id;
        }

        HouseholdMember::where("resident_id", $resident_id)->delete();

        foreach ($houseHoldMember as $item) {
            $item['resident_id'] = $resident_id;
            HouseholdMember::create($item);
        }

        return response()->json(['status' => 'success', 'message' => 'Barangay ID saved successfully!']);
    }

    public function get_certification(Request $request)
    {
        $query = Certification::where('certification_type', $request->type);

        if ($request->filled('dateFrom')) {
            $query->whereDate('date_issued', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('date_issued', '<=', $request->dateTo);
        }

        $data = $query->get();

        return response()->json(['data' => $data]);
    }

    public function get_dashboard_table(Request $request)
    {
        $query = Certification::query();

        if ($request->filled('dateFrom')) {
            $query->whereDate('date_issued', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('date_issued', '<=', $request->dateTo);
        }

        $data = $query->get();
        
        return response()->json(['data' => $data]);
    }

    public function get_brgy_id(Request $request)
    {
        $type = $request->type;
        $query = BrgyID::query();
        if ($request->filled('dateFrom')) {
            $query->whereDate('dateclaim', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('dateclaim', '<=', $request->dateTo);
        }

        $data = $query->get();
        return response()->json(['data' => $data]);
    }

    public function get_quary(Request $request)
    {
        $query = Quarry::query();
        if ($request->filled('dateFrom')) {
            $query->whereDate('created_at', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('created_at', '<=', $request->dateTo);
        }

        $data = $query->get();
        return response()->json(['data' => $data]);
    }

    public function getRBI1(Request $request)
    {
        $query = Resident::query();

        // filter by type
        if ($request->type && $request->type != "all") {
            $query->where('resident_type', $request->type);
        }

        // date filters (for created_at)
        if ($request->filled('dateFrom')) {
            $query->whereDate('created_at', '>=', $request->dateFrom);
        }

        if ($request->filled('dateTo')) {
            $query->whereDate('created_at', '<=', $request->dateTo);
        }

        $data = $query->get()->map(function ($resident) {

            $resident->household_member = HouseholdMember::where(
                'resident_id',
                $resident->resident_id
            )->get();

            return $resident;
        });

        return response()->json([
            'data' => $data
        ]);
    }

    public function deleteCertification(Request $request)
    {
        $data = Certification::where('certification_id', $request->certification_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Certification deleted successfully!']);
    }
    public function deleteQuarry(Request $request)
    {
        $data = Quarry::where('quarry_id', $request->quarry_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Quarry deleted successfully!']);
    }
    public function deleteBrgyId(Request $request)
    {
        $data = BrgyID::where('brgy_id', $request->brgy_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Barangay ID deleted successfully!']);
    }
    public function deleteRBI(Request $request)
    {
        $data = Resident::where('resident_id', $request->resident_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Barangay RBI deleted successfully!']);
    }
    public function viewBrgyCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.brgycertification', ['certification' => $certification]);
    }

    public function viewClearanceCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.clearancecertification', ['certification' => $certification]);
    }
    public function viewTreesCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.treescertification', ['certification' => $certification]);
    }
    public function viewJobSeekerCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.jobseekercertification', ['certification' => $certification]);
    }
    public function viewGoodMoralCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.goodmoralcertification', ['certification' => $certification]);
    }
    public function viewIndigencyCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.indigencycertification', ['certification' => $certification]);
    }
    public function viewLiveStockCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.livestockcertification', ['certification' => $certification]);
    }
    public function viewMotorCycleCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.motorcyclecertification', ['certification' => $certification]);
    }
    public function viewPiggeryCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.piggerycertification', ['certification' => $certification]);
    }
    public function viewQuarryCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.quarrycertification', ['certification' => $certification]);
    }
    public function viewLotCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.lotcertification', ['certification' => $certification]);
    }
    public function report_brgy(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'brgy')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();


        return view('secretary.reports.report_brgy', compact('data'));
    }

    public function report_brgy_clearance(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'clearance')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_brgy_clearance', compact('data'));
    }

    public function report_trees(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'trees')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_trees', compact('data'));
    }

    public function report_jobseeker(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'jobseeker')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_jobseeker', compact('data'));
    }

    public function report_goodmoral(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'goodmoral')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_goodmoral', compact('data'));
    }
    public function report_indigency(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'indigency')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_indigency', compact('data'));
    }

    public function report_livestock(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'livestock')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_livestock', compact('data'));
    }

    public function report_lot(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'lot')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_lot', compact('data'));
    }

    public function report_motorcycle(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'motorcycle')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_motorcycle', compact('data'));
    }

    public function report_piggery(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'piggery')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_piggery', compact('data'));
    }

    public function report_quarry(Request $request)
    {
        $monthYear = $request->query('month');

        $data = Certification::where('certification_type', 'quarry')

            ->when($monthYear, function ($query) use ($monthYear) {

                $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

                $query->whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month);
            })

            ->get();

        return view('secretary.reports.report_quarry', compact('data'));
    }



    public function report_brgy_id(Request $request)
    {
        $monthYear = $request->query('month');

        $data = BrgyID::when($monthYear, function ($query) use ($monthYear) {

            $date = \Carbon\Carbon::createFromFormat('Y-m', $monthYear);

            $query->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month);
        })

            ->get();


        return view('secretary.reports.report_brgy_id', compact('data'));
    }

    public function getChartStatistics(Request $request)
    {
        $month = $request->input('month');
        $type = $request->input('type');
        $year = $request->input('year', Carbon::now()->year);

        // KEY is what is stored in the database, VALUE is the full readable name
        $certificateMap = [
            'brgy'        => 'Barangay',
            'clearance'   => 'Barangay Clearance',
            'trees'       => 'Trees',
            'jobseeker'   => 'First Time Job Seeker',
            'goodmoral'   => 'Good Moral Character',
            'indigency'   => 'Indigency',
            'livestock'   => 'Livestock',
            'motorcycle'  => 'Motorcycle',
            'piggery'     => 'Piggery',
            'quarry'      => 'Quarry',
            'lot'         => 'Lot'
        ];

        $query = Certification::query()->whereYear('date_issued', $year);

        if ($month && $month !== 'all') {
            $query->whereMonth('date_issued', $month);
        }
        if (!empty($type) && $type != "all") {
            $query->where('certification_type', $type);
        }

        // Query groups by the short code values stored in your DB
        $results = $query->select('certification_type', DB::raw('COUNT(*) as total'))
            ->groupBy('certification_type')
            ->get();

        $labels = [];
        $series = [];

        // Loop through the map to ensure every single option is represented
        foreach ($certificateMap as $dbValue => $displayLabel) {
            $labels[] = $displayLabel; // Sends the full name straight to the chart labels
            $match = $results->firstWhere('certification_type', $dbValue);
            $series[] = $match ? $match->total : 0;
        }

        return response()->json([
            'labels' => $labels,
            'series' => $series
        ]);
    }
}
