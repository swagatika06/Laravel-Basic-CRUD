<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;



Route::get('/patients', [PatientController::class, 'getAllPatients']);
Route::get('/patients/{id}', [PatientController::class, 'getPatient']);
Route::post('/patients/', [PatientController::class, 'createPatient']);
Route::delete('/patients/{id}', [PatientController::class, 'deletePatient']);
Route::put('patients/{id}', [PatientController::class, 'updatePatient']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
