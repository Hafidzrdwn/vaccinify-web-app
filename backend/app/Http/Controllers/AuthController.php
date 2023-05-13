<?php

namespace App\Http\Controllers;

use App\Models\Society;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function society_login(Request $request)
    {
        $data = Validator::make($request->all(), [
            'id_card_number' => 'required',
            'password' => 'required'
        ]);

        if ($data->fails()) {
            return response()->json([
                'message' => $data->errors()
            ], 401);
        }

        $society = Society::with('regional')->where('id_card_number', $request->id_card_number)->first();

        if ($society) {
            if ($request->password == $society->password) {
                $society->update([
                    'login_tokens' => $society->makeToken()
                ]);

                $society['token'] = $society->login_tokens;

                return response()->json($society, 200);
            }
        }

        return response()->json([
            "message" => "ID Card Number or Password incorrect"
        ], 401);
    }

    public function society_logout(Request $request)
    {
        $society = Society::where('login_tokens', $request->query('token'))->first();

        if ($society) {

            $society->update([
                'login_tokens' => null
            ]);

            return response()->json([
                "message" => "Logout success"
            ], 200);
        } else {
            return response()->json([
                "message" => "Invalid token"
            ], 401);
        }
    }
}
