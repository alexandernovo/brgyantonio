<?php

namespace App\Http\Controllers;

use App\Models\BrgyID;
use App\Models\Certification;
use App\Models\Collection;
use App\Models\KagawadRecord;
use App\Models\Quarry;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function admin_dashboard()
    {
        $totalCertification = Certification::count();
        $totalCollection = Collection::sum('payment_amount');
        $totalUnreturned = KagawadRecord::where('record_type', 'borrowed')->where('status', 'Unreturned')->count();

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

        return view('admin.views.admin_dashboard', compact('totalCertification', 'totalCollection', 'totalUnreturned', 'blotter', 'borrowed'));
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
    public function report_admin()
    {
        return view("admin.views.report_admin");
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

    public function getStatisticsChart(Request $request)
    {
        $category = $request->category;
        $year = $request->year ?? now()->year;

        $months = collect(range(1, 12));

        $data = [];

        switch ($category) {

            case 'brgy_id':

                $records = BrgyID::selectRaw('MONTH(dateclaim) as month, COUNT(*) as total')
                    ->whereYear('dateclaim', $year)
                    ->groupBy(DB::raw('MONTH(dateclaim)'))
                    ->pluck('total', 'month');

                break;

            case 'certification':

                $records = Certification::selectRaw('MONTH(date_issued) as month, COUNT(*) as total')
                    ->whereYear('date_issued', $year)
                    ->groupBy(DB::raw('MONTH(date_issued)'))
                    ->pluck('total', 'month');

                break;

            case 'collection':

                $records = Collection::selectRaw('MONTH(payment_date) as month, COUNT(*) as total')
                    ->whereYear('payment_date', $year)
                    ->groupBy(DB::raw('MONTH(payment_date)'))
                    ->pluck('total', 'month');

                break;

            case 'blotter':

                $records = KagawadRecord::selectRaw('MONTH(date_of_complaints) as month, COUNT(*) as total')
                    ->where('record_type', 'blotter')
                    ->whereYear('date_of_complaints', $year)
                    ->groupBy(DB::raw('MONTH(date_of_complaints)'))
                    ->pluck('total', 'month');

                break;

            case 'borrowed':

                $records = KagawadRecord::selectRaw('MONTH(date_of_borrowed) as month, COUNT(*) as total')
                    ->where('record_type', 'borrowed')
                    ->whereYear('date_of_borrowed', $year)
                    ->groupBy(DB::raw('MONTH(date_of_borrowed)'))
                    ->pluck('total', 'month');

                break;

            case 'quarry':

                $records = Quarry::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                    ->whereYear('created_at', $year)
                    ->groupBy(DB::raw('MONTH(created_at)'))
                    ->pluck('total', 'month');

                break;
            case 'all':

                $records = collect();

                $sources = [
                    BrgyID::selectRaw('MONTH(dateclaim) as month, COUNT(*) as total')
                        ->whereYear('dateclaim', $year)
                        ->groupBy(DB::raw('MONTH(dateclaim)'))
                        ->pluck('total', 'month'),

                    Certification::selectRaw('MONTH(date_issued) as month, COUNT(*) as total')
                        ->whereYear('date_issued', $year)
                        ->groupBy(DB::raw('MONTH(date_issued)'))
                        ->pluck('total', 'month'),

                    Collection::selectRaw('MONTH(payment_date) as month, COUNT(*) as total')
                        ->whereYear('payment_date', $year)
                        ->groupBy(DB::raw('MONTH(payment_date)'))
                        ->pluck('total', 'month'),

                    KagawadRecord::selectRaw('MONTH(date_of_complaints) as month, COUNT(*) as total')
                        ->where('record_type', 'blotter')
                        ->whereYear('date_of_complaints', $year)
                        ->groupBy(DB::raw('MONTH(date_of_complaints)'))
                        ->pluck('total', 'month'),

                    KagawadRecord::selectRaw('MONTH(date_of_borrowed) as month, COUNT(*) as total')
                        ->where('record_type', 'borrowed')
                        ->whereYear('date_of_borrowed', $year)
                        ->groupBy(DB::raw('MONTH(date_of_borrowed)'))
                        ->pluck('total', 'month'),

                    Quarry::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->whereYear('created_at', $year)
                        ->groupBy(DB::raw('MONTH(created_at)'))
                        ->pluck('total', 'month'),
                ];

                foreach ($sources as $source) {
                    foreach ($source as $month => $total) {
                        $records[$month] = ($records[$month] ?? 0) + $total;
                    }
                }

                break;
            default:
                $records = collect();
        }

        foreach ($months as $month) {
            $data[] = $records[$month] ?? 0;
        }

        return response()->json($data);
    }

    public function user_profile(Request $request)
    {
        return view('admin.views.profile');
    }
}
