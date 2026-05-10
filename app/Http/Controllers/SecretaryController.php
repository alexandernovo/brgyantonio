<?php

namespace App\Http\Controllers;

use App\Models\Certification;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Contracts\Session\Session;

class SecretaryController extends Controller
{
    public function secretary_dashboard(Request $request)
    {
        return view('secretary.views.secretary_dashboard');
    }

    public function certification_select(Request $request)
    {
        return view('secretary.views.certification_select');
    }

    public function certificate_brgy(Request $request)
    {
        return view('secretary.views.certificate_brgy');
    }

    public function certificate_clearance(Request $request)
    {
        return view('secretary.views.certificate_clearance');
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

    public function get_certification(Request $request)
    {
        $type = $request->type;
        $data = Certification::where("certification_type", $type)->get();

        return response()->json(['data' => $data]);
    }


    public function deleteCertification(Request $request)
    {
        $data = Certification::where('certification_id', $request->certification_id)->delete();

        return response()->json(['status' => 'success', 'message' => 'Certification deleted successfully!']);
    }

    public function viewBrgyCertification(Request $request)
    {
        $certification_id = $request->query('certification_id');
        $certification = Certification::where('certification_id', $certification_id)->first();
        return view('secretary.print.brgycertification', ['certification' => $certification]);
    }
}
