<?php

namespace App\Http\Controllers;

use App\Models\Consultation;
use App\Models\Medical;
use App\Models\Society;
use App\Models\Spot;
use App\Models\SpotVaccine;
use App\Models\Vaccination;
use App\Models\Vaccine;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VaccinationController extends Controller
{
    public function register(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'spot_id' => 'required',
            'date' => 'required|date'
        ]);

        if ($validated->fails()) {
            return response()->json([
                'message' => 'Invalid field',
                'errors' => $validated->errors()
            ], 401);
        }

        $society = Society::where('login_tokens', $request->query('token'))->first();
        $consultation = Consultation::where('society_id', $society->id)->first();

        $total_consultation = Consultation::where('society_id', $society->id)->get()->count();
        $total_vaccine = Vaccination::where('society_id', $society->id)->get()->count();

        $doctor_id = Medical::where([
            'spot_id' => $request->spot_id,
            'role' => 'doctor'
        ])->first()->id;
        $officer_id = Medical::where([
            'spot_id' => $request->spot_id,
            'role' => 'officer'
        ])->first()->id;


        $spot_vaccine = SpotVaccine::where('spot_id', $request->spot_id)->first();
        // $spot = Spot::where()
        $vaccine = Vaccine::where('id', $spot_vaccine->vaccine_id)->first();
        $data = $request->all();

        if ($consultation) {
            if ($consultation->status == 'accepted') {

                if ($total_vaccine >= 2) {
                    return response()->json([
                        'message' => "Society has been 2x vaccinated"
                    ], 401);
                } else if ($total_vaccine == 1) {

                    if ($total_consultation < 2) {
                        return response()->json([
                            'message' => "To register for second vaccination, you must consult a doctor first."
                        ], 401);
                    } else {
                        $second_consult = Consultation::where(['society_id' => $society->id, 'status' => 'pending'])->latest()->first();

                        if ($second_consult) {
                            return response()->json([
                                'message' => "Your Second consultation must be accepted by doctor before"
                            ], 401);
                        } else {
                            $first_vaccination = Vaccination::where('society_id', $society->id)->first();
                            $second_vaccination_date = Carbon::parse($request->date);
                            $date_diff = $second_vaccination_date->diffInDays(Carbon::parse($first_vaccination->date));

                            if ($date_diff >= 30) {
                                $data['dose'] = 2;
                                $data['society_id'] = $society->id;
                                $data['vaccine_id'] = $vaccine->id;
                                $data['doctor_id'] = $doctor_id;
                                $data['officer_id'] = $officer_id;

                                Vaccination::create($data);

                                return response()->json([
                                    'message' => "Second vaccination registered successful"
                                ], 200);
                            } else {
                                return response()->json([
                                    'message' => "Wait at least +30 days from 1st Vaccination"
                                ], 401);
                            }
                        }
                    }
                } else {
                    $data['dose'] = 1;
                    $data['society_id'] = $society->id;
                    $data['vaccine_id'] = $vaccine->id;
                    $data['doctor_id'] = $doctor_id;
                    $data['officer_id'] = $officer_id;

                    Vaccination::create($data);

                    return response()->json([
                        'message' => "First vaccination registered successful"
                    ], 200);
                }
            } else {
                return response()->json([
                    'message' => "Your consultation must be accepted by doctor before"
                ], 401);
            }
        } else {
            return response()->json([
                'message' => "You must consultation first before register to the vaccination"
            ], 401);
        }
    }

    public function get_vaccinations(Request $request)
    {
        $society = Society::where('login_tokens', $request->query('token'))->first();

        $first = Vaccination::query()->with(['spot.regional', 'vaccine', 'vaccinator'])->where([
            'society_id' => $society->id,
            'dose' => 1
        ])->first();
        $second = Vaccination::query()->with(['spot.regional', 'vaccine', 'vaccinator'])->where([
            'society_id' => $society->id,
            'dose' => 2
        ])->first();

        $first_vaccinations = Vaccination::where('dose', 1)->orderBy('created_at', 'asc')->get();
        $second_vaccinations = Vaccination::where('dose', 2)->orderBy('created_at', 'asc')->get();

        if ($first) {

            $first['vaccination_date'] = $first->date;
            $first['status'] = 'done';

            $fqueue = $first_vaccinations->search(function ($fv) use ($society) {
                return $fv->society_id == $society->id;
            });

            $first['queue'] = $fqueue + 1;
        }
        if ($second) {

            $second['vaccination_date'] = $second->date;
            $second['status'] = 'done';

            $squeue = $second_vaccinations->search(function ($sv) use ($society) {
                return $sv->society_id == $society->id;
            });

            $second['queue'] = $squeue + 1;
        }

        return response()->json([
            'vaccinations' => [
                'first' => $first,
                'second' => $second
            ]
        ], 200);
    }
}
