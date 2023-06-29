<?php

namespace App\Http\Controllers\Doctor;

use Carbon\Carbon;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Vote;

class ChartJsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        //Grafico per mese recensioni
        $reviewMese = Review::where('doctor_id', $user->doctor_id)
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->selectRaw('count(id) as count')
            ->selectRaw('MONTH(created_at) as mese')
            ->groupBy('mese')
            ->get();

        //Grafico per anno recensioni
        $reviewAnno = Review::where('doctor_id', $user->doctor_id)
            ->selectRaw('count(id) as count')
            ->selectRaw('YEAR(created_at) as anno')
            ->groupBy('anno')
            ->get();
        //dd($reviewAnno);
        //Grafico per mese messaggi
        $messageMese = Message::where('doctor_id', $user->doctor_id)
            ->whereYear('created_at', Carbon::now()->format('Y'))
            ->selectRaw('count(id) as count')
            ->selectRaw('MONTH(created_at) as mese')
            ->groupBy('mese')
            ->get();

        //Grafico per anno messaggi
        $messageAnno = Message::where('doctor_id', $user->doctor_id)
            ->selectRaw('count(id) as count')
            ->selectRaw('YEAR(created_at) as anno')
            ->groupBy('anno')
            ->get();

        //Grafico per media voti per mese
        $votiMese= Vote::join('doctor_vote', 'doctor_vote.vote_id', '=', 'votes.id')->where('doctor_vote.doctor_id', $user->doctor_id)
        ->whereYear('doctor_vote.created_at', Carbon::now()->format('Y'))
        ->selectRaw('avg(votes.vote) as count')
        ->selectRaw('MONTH(doctor_vote.created_at) as mese')
        ->groupBy('mese')
        ->get();

        //Grafico per media voti per anno
        $votiAnno= Vote::join('doctor_vote', 'doctor_vote.vote_id', '=', 'votes.id')->where('doctor_vote.doctor_id', $user->doctor_id)
        ->selectRaw('avg(votes.vote) as count')
        ->selectRaw('YEAR(doctor_vote.created_at) as anno')
        ->groupBy('anno')
        ->get();

        return view('doctor.chartjs', compact('reviewMese', 'reviewAnno', 'messageMese', 'messageAnno','votiMese', 'votiAnno'));
    }
}
