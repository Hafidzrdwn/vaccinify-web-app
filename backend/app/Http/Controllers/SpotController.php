<?php

namespace App\Http\Controllers;

use App\Models\Society;
use App\Models\Spot;
use App\Models\SpotVaccine;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    public function get_spots(Request $request)
    {
        $society = Society::with('regional')->where('login_tokens', $request->query('token'))->first();
        $spots = Spot::where('regional_id', $society->regional->id)->get();
        // $total_vaccinations = Vaccination::where('society_id', $society->id)->get()->count();
        $vaccines = Vaccine::all();
        $available_vaccines = [];

        if (!$society) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        foreach ($spots as $spot) {

            foreach ($vaccines as $vaccine) {

                $check_spot = SpotVaccine::where([
                    'spot_id' => $spot->id,
                    'vaccine_id' => $vaccine->id
                ])->exists();

                $available = $check_spot ? true : false;
                $available_vaccines[$vaccine->name] = $available;
            }

            // if ($spot->serve != $total_vaccinations) {
            //     $spot['unavailable'] = true;
            // }

            $spot['available_vaccines'] = $available_vaccines;
        }

        return response()->json([
            'spots' => $spots
        ], 200);
    }

    public function show_spot(Request $request, Spot $spot)
    {
        $society = Society::with('regional')->where('login_tokens', $request->query('token'))->first();
        if (!$society) {
            return response()->json([
                'message' => 'Unauthorized user'
            ], 401);
        }

        $date = ($request->date) ? $request->date : now();

        $vaccination_count = Vaccination::where([
            'date' => $date,
            'spot_id' => $spot->id
        ])->count();

        return response()->json([
            'date' => Carbon::parse($date)->format('F d, Y'),
            'spot' => $spot,
            'vaccinations_count' => $vaccination_count
        ], 200);
    }
}
