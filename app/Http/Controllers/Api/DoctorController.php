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
        $doctors = Doctor::with('specializations', 'sponsorships', 'votes', 'user')->get();

        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    // QUERY FOR DOCTOR DETAIL
    public function show(int $id)
    {
        $doctor = Doctor::where('id', $id)->first();

        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }
}
