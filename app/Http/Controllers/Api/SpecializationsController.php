<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class SpecializationsController extends Controller
{
    public function index()
    {
        $specializations = Specialization::with('doctors')->get();

        return response()->json([
            'success' => true,
            'results' => $specializations
        ]);
    }
}
