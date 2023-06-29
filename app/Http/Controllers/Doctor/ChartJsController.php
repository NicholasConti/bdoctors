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

        //Grafico per media voti per anno

        return view('doctor.chartjs', compact('reviewMese', 'reviewAnno', 'messageMese', 'messageAnno'));
    }
}
