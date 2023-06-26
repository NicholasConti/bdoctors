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
        $isSponsor=$user->doctor()->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->first();
        if (count($isSponsor->sponsorships) > 0) $isSponsor=$isSponsor->sponsorships[0];
        else $isSponsor=null;
        return view('doctor.dashboard',compact('user','spec','sponsor','isSponsor'));
    }
}
