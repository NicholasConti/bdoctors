<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChartJsController extends Controller
{
    public function index(){
        return view('doctor.chartjs');
    }
}
