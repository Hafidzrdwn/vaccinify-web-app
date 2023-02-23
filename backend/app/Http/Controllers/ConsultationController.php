<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Society;
use App\Models\Vaccination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ConsultationController extends Controller
{
    public function request_consult(Request $request)
    {
        $data = Validator::make($request->all(), [
            'disease_history' => 'required',
            'current_symptoms' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json([
                'message' => $data->errors()
            ], 401);
        }

        $society = Society::where('login_tokens', $request->query('token'))->first();
        $total_vaccine = Vaccination::where('society_id', $society->id)->get()->count();
        $pending_consult_req = Consultation::where([
            'society_id' => $society->id,
            'status' => 'pending'
        ])->first();

        if ($total_vaccine >= 2) {
            return response()->json([
                'message' => "Society has been 2x vaccinated"
            ], 401);
        } else {
            if ($pending_consult_req) {
                return response()->json([
                    'message' => 'Please wait, your first consultation request is still pending.'
                ], 401);
            } else {
                $data = $request->all();
                $data['society_id'] = $society->id;
                Consultation::create($data);
            }
        }

        return response()->json([
            'message' => 'Request consultation sent successful'
        ], 200);
    }

    public function get_consult(Request $request)
    {
        $society = Society::where('login_tokens', $request->query('token'))->first();
        $consultations = Consultation::with('doctor')->where('society_id', $society->id)->first(['id', 'status', 'disease_history', 'current_symptoms', 'doctor_notes']);

        return response()->json([
            'consultations' => $consultations
        ], 200);
    }
}
