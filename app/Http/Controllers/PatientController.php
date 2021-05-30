<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;



class PatientController extends Controller
{
    public function getAllPatients() {
        $patient = Patient::get()->toJson(JSON_PRETTY_PRINT);
        return response($patient, 200);
      }
    public function createPatient(Request $request) {
        $patient = new Patient;
        $patient->uuid = $request->uuid;
        $patient->name = $request->name;
        $patient->phone = $request->phone;
        $patient->height = $request->height;
        $patient->weight = $request->weight;
        $patient->save();
    
        return response()->json([
            "message" => "patient record created"
        ], 201);
      }
      public function getPatient($id) {
        if (Patient::where('id', $id)->exists()) {
            $patient = Patient::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($patient, 200);
          } else {
            return response()->json([
              "message" => "patient not found"
            ], 404);
          }
      }
    public function updatePatient(Request $request, $id) {
        if (Patient::where('id', $id)->exists()) {
            $patient = Patient::find($id);
            $patient->uuid = is_null($request->name) ? $patient->uuid : $request->uuid;
            $patient->name = is_null($request->name) ? $patient->name : $request->name;
            $patient->phone = is_null($request->phone) ? $patient->phone : $request->phone;
            $patient->height = is_null($request->height) ? $patient->height : $request->height;
            $patient->weight = is_null($request->weight) ? $patient->weight : $request->weight;
         
            $patient->save();
    
            return response()->json([
                "message" => "records updated successfully"
            ], 200);
            } else {
            return response()->json([
                "message" => "patient not found"
            ], 404);
            
        }
    }
    public function deletePatient ($id) {
      if(Patient::where('id', $id)->exists()) {
        $patient = Patient::find($id);
        $patient->delete();

        return response()->json([
          "message" => "records deleted"
        ], 202);
      } else {
        return response()->json([
          "message" => "patient not found"
        ], 404);
      }
    }
}