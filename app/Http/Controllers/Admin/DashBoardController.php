<?php

namespace App\Http\Controllers\Admin;

use App\Models\Sponsorship;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashBoardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $end_date=null;
        $spec=Specialization::all();
        $sponsor=Sponsorship::all();
        $isSponsor=$user->doctor()->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d H:i:s'));
            }]
        )->first();
        if ($isSponsor && count($isSponsor->sponsorships) > 0){
            $isSponsor=$isSponsor->sponsorships[0];
            $end_date=DB::table('doctor_sponsorship')->where('sponsorship_id', $isSponsor->id)->where('doctor_id', $user->doctor_id)->orderBy('end_date', 'DESC')->select('end_date')->first();
            $end_date=$end_date->end_date;
        }
        else $isSponsor=null;
        return view('doctor.dashboard',compact('user','spec','sponsor','isSponsor', 'end_date'));
    }
}
