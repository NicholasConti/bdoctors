<?php

namespace App\Http\Controllers\Api;

use App\Models\Vote;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    // QUERY FOR ALL DOCTORS
    public function index()
    {
        $doctors = Doctor::with('specializations', 'user')->get();

        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    // QUERY FOR DOCTOR DETAIL
    public function show(int $id)
    {
        $doctor = Doctor::where('id', $id)->with('specializations', 'sponsorships', 'votes', 'user')->first();

        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }

    // QUERY FOR DOCTORS SEARCH BY ID_SPECIALIZATION
    public function search(int $idSpec){
        $doctor= Doctor::join('doctor_specialization', 'doctor_specialization.doctor_id','=', 'doctors.id')->where('doctor_specialization.specialization_id', $idSpec)->select('doctors.*')->with('user','specializations')->get();

        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }

    // QUERY DOCTOR BY FILTER VOTE
    public function filterVote(){
        //$doctor=Doctor::with(['votes'])->join('doctor_vote', 'doctor_vote.doctor_id' , '=', 'doctors.id')->join('votes', 'votes.id', '=', 'doctor_vote.vote_id')->select('doctors.*')->get();

        $doctor=Vote::join('doctor_vote','doctor_vote.vote_id','=','votes.id')->rightJoin('doctors','doctors.id','=','doctor_vote.doctor_id')->select(DB::raw('avg(votes.vote) as media, doctors.id'))->groupBy('doctors.id')->orderByDesc('media')->get();
        return response()->json([
            'success' => true,
            'results' => $doctor
        ]);
    }
}
