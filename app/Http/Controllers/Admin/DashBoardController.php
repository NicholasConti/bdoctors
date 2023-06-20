<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $spec=Specialization::all();
        $sponsor=Sponsorship::all();
        return view('doctor.dashboard',compact('user','spec','sponsor'));
    }
}
