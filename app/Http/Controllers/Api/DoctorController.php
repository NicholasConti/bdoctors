<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    // QUERY FOR ALL DOCTORS
    public function index()
    {
        $doctors = Doctor::with('specializations', 'user')->get();

        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    // QUERY FOR DOCTOR DETAIL
    public function show(int $id)
    {
        $doctor = Doctor::where('id', $id)->with('specializations', 'sponsorships', 'votes', 'user')->first();

        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }

    public function search(int $idSpec){
        $doctor= Doctor::join('doctor_specialization', 'doctor_specialization.doctor_id','=', 'doctors.id')->where('doctor_specialization.specialization_id', $idSpec)->select('doctors.*')->with('user','specializations')->get();

        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }
}
