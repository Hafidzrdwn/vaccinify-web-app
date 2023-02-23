<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        Route::post('/login', 'AuthController@society_login');
        Route::post('/logout', 'AuthController@society_logout');
    });

    Route::middleware('checkauth')->group(function () {
        Route::post('/consultations', 'ConsultationController@request_consult');
        Route::get('/consultations', 'ConsultationController@get_consult');

        Route::get('/spots', 'SpotController@get_spots');
        Route::get('/spots/{spot}', 'SpotController@show_spot');

        Route::post('/vaccinations', 'VaccinationController@register');
        Route::get('/vaccinations', 'VaccinationController@get_vaccinations');
    });
});
