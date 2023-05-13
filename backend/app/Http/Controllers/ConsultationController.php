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
        $society = Society::where('login_tokens', $request->query('token'))->first();

        if (!$society) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        $data = $request->all();
        $data['society_id'] = $society->id;
        Consultation::create($data);

        return response()->json([
            'message' => 'Request consultation sent successful'
        ], 200);
    }

    public function get_consult(Request $request)
    {
        $society = Society::where('login_tokens', $request->query('token'))->first();

        if (!$society) {
            return response()->json([
                'message' => "Unauthorized user"
            ], 401);
        }

        $consultations = Consultation::where('society_id', $society->id)->first();

        return response()->json([
            'consultations' => $consultations
        ], 200);
    }
}
