<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Patient;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // add patient function

    public function addPatient(Request $request)
    {
        // Validate the required fields
        $validatedData = $request->validate([
            'name' => 'required',
            'birthday' => 'required',
            'contact_no' => 'required',
            'photo' => 'required',
            'nic' => 'required',
            'notes' => 'required',
        ]);

        $patient_data = Patient::create([
            'name' => $request->input('name'),
            'birthday' => $request->input('birthday'),
            'contact_no' => $request->input('contact_no'),
            'photo' => $request->input('photo'),
            'nic' => $request->input('nic'),
            'notes' => $request->input('notes'),
        ]);

        return response()->json($patient_data, 201);
    }

    // get all patients function

    public function getPatients()
    {
        $all_patients = Patient::get(['id', 'name', 'birthday', 'contact_no', 'photo', 'nic', 'notes']);
        return $all_patients;
    }
}
