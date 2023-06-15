<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Specialization;
use Illuminate\Http\Request;

class DashBoardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $specializzazioni=Specialization::all();
        return view('doctor.dashboard',compact('user','specializzazioni'));
    }
}
