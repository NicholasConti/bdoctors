<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('specializations', 'sponsorships', 'votes', 'user')->get();

        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }
}
