<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sponsorship;

class PaymentController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'package' => 'exists:sponsorships,id'
        ]);

        $user = auth()->user();

        $isSponsor = $user->doctor()->with(
            ['sponsorships' => function ($item) {
                return $item->where('end_date', '>=', date('Y-m-d'));
            }]
        )->first();
        if (count($isSponsor->sponsorships) === 0){
            $data=$request->all();
            return view('doctor.form', compact('data'));
        }
        return redirect()->route('doctor.dashboard')->with('problem', 'You are already sponsored!!');;
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_sponsor' => 'exists:sponsorships,id'
        ]);

        $user = auth()->user();

        $isSponsor = $user->doctor()->with(
            ['sponsorships' => function ($item) {
                return $item->where('end_date', '>=', date('Y-m-d'));
            }]
        )->first();

        if (count($isSponsor->sponsorships) === 0){
            $data=$request->all();
            $newSponsor=$user->doctor;
            $sponsorDuration=Sponsorship::where('id', $data['id_sponsor'])->select('duration')->first();
            $date=Carbon::now()->addHours($sponsorDuration->duration);
            $newSponsor->sponsorships()->attach($data['id_sponsor'], ['end_date' => $date]);
        }

        return redirect()->route('doctor.dashboard')->with('message', 'Payment done, now you are sponsored!!');;
    }
}
