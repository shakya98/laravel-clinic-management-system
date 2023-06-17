<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Prescription;
use App\Models\Bill;
use App\Models\Record;
use Illuminate\Support\Facades\DB;


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

    // add record function

    public function addRecord(Request $request, $id)
    {
        $record = $this->createRecord($request, $id);
        $this->createPrescription($request, $record);
        $this->createBill($request, $record, $id);

        return $record;
    }

    private function createRecord(Request $request, $id)
    {
        return Record::create([
            'record' => $request->input('record'),
            'patient_id' => $id,
        ]);
    }

    private function createPrescription(Request $request, Record $record)
    {
        Prescription::create([
            'record_id' => $record->id,
            'prescription' => $request->input('prescription'),
        ]);
    }

    private function createBill(Request $request, Record $record, $id)
    {
        Bill::create([
            'record_id' => $record->id,
            'patient_id' => $id,
            'total_bill' => $request->input('total_bill'),
        ]);
    }

    //getting total bill amount

    public function getTotalBillAmount(Request $request)
    {
        // Validate the required fields
        $validatedData = $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $totalBillData = DB::table('bills')
            ->join('patients', 'bills.patient_id', '=', 'patients.id')
            ->join('records', 'bills.record_id', '=', 'records.id')
            ->join('prescriptions', 'records.id', '=', 'prescriptions.record_id')
            ->whereBetween('bills.created_at', [$startDate, $endDate])
            ->select(
                'patients.name as patient_name',
                'records.id as record_id',
                'prescriptions.id as prescription_id',
                'bills.total_bill'
            )
            ->get();

        $totalBillSum = DB::table('bills')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_bill');

        return response()->json([
            'totalBillData' => $totalBillData,
            'totalBillSum' => $totalBillSum
        ]);
    }
}
