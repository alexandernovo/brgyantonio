<?php

namespace App\Http\Controllers;

use App\Models\BrgyID;
use App\Models\Certification;
use App\Models\Resident;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;

class SecretaryController extends Controller
{
    public function secretary_dashboard(Request $request)
    {
        return view('secretary.views.secretary_dashboard');
    }

    public function report_brgy(Request $request)
    {
        return view('secretary.reports.report_brgy');
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

        if ($data['brgy_id'] != 0 || $data['brgy_id'] != "") {
            BrgyID::where("brgy_id", $data['brgy_id'])->update($data);
        } else {
            BrgyID::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Barangay ID saved successfully!']);
    }

    public function storeRBI(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);

        if ($data['resident_id'] != 0 || $data['resident_id'] != "") {
            Resident::where("resident_id", $data['resident_id'])->update($data);
        } else {
            Resident::create($data);
        }

        return response()->json(['status' => 'success', 'message' => 'Barangay ID saved successfully!']);
    }

    public function get_certification(Request $request)
    {
        $type = $request->type;
        $data = Certification::where("certification_type", $type)->get();

        return response()->json(['data' => $data]);
    }

    public function get_brgy_id(Request $request)
    {
        $type = $request->type;
        $data = BrgyID::all();

        return response()->json(['data' => $data]);
    }

    public function getRBI1(Request $request)
    {
        $type = $request->type;
        $data = Resident::where('resident_type', $type)->get();

        return response()->json(['data' => $data]);
    }

    public function deleteCertification(Request $request)
    {
        $data = Certification::where('certification_id', $request->certification_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Certification deleted successfully!']);
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
}
