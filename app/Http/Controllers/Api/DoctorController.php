<?php

namespace App\Http\Controllers\Api;

use App\Models\Vote;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use App\Models\User;

class DoctorController extends Controller
{
    // QUERY FOR ALL DOCTORS
    public function index()
    {
        $doctors = Doctor::with('user')->withCount('reviews')->withAvg('votes', 'vote')->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->get();

        $doc=[];

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) > 0) $doc[]=$item;
        }

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) == 0) $doc[]=$item;
        }

        return response()->json([
            'success' => true,
            'results' => $doc
        ]);
    }

    // QUERY FOR SPONSORSHIP ACTIVE DOCTORS
    public function sponsor(){
        $doctors = Doctor::with('user')->withCount('reviews')->withAvg('votes', 'vote')->join('doctor_sponsorship as sponsor', 'sponsor.doctor_id', '=', 'doctors.id')->where('sponsor.end_date', '>=', date('Y-m-d'))->get();

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
    // QUERY FOR DOCTORS SEARCH BY NAME AND SURNAME
    public function search(string $text){
        $doctors=Doctor::with('user')->join('users', 'users.doctor_id', '=', 'doctors.id')->where('users.name','LIKE','%'.$text.'%')->orWhere('users.surname','LIKE','%'.$text.'%')->select('doctors.*')->withCount('reviews')->withAvg('votes', 'vote')->withCount('reviews')->withAvg('votes', 'vote')->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->get();

        $doc=[];

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) > 0) $doc[]=$item;
        }

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) == 0) $doc[]=$item;
        }

        return response()->json([
            'success' => true,
            'results' => $doc
        ]);
    }

    // QUERY FOR DOCTORS SEARCH BY ID_SPECIALIZATION
    public function searchBySpec(int $idSpec){
        $doctors= Doctor::join('doctor_specialization', 'doctor_specialization.doctor_id','=', 'doctors.id')->where('doctor_specialization.specialization_id', $idSpec)->select('doctors.*')->with('user')->withCount('reviews')->withAvg('votes', 'vote')->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->get();

        $doc=[];

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) > 0) $doc[]=$item;
        }

        foreach ($doctors as $item) {
            if (count($item['sponsorships']) == 0) $doc[]=$item;
        }

        return response()->json([
            'success' => true,
            'results' => $doc
        ]);
    }

    // QUERY FOR DOCTORS SEARCH BY MIN MEDIA VOTE
    public function searchByVote(int $vote){
        $doctors = Doctor::with('user')->withCount('reviews')->withAvg('votes', 'vote')->having('votes_avg_vote', '>=', $vote)->with(
            ['sponsorships' => function($item){
                return $item->where('end_date' , '>=', date('Y-m-d'));
            }]
        )->get();

        return response()->json([
            'success' => true,
            'results' => $doctors
        ]);
    }

    // QUERY DOCTOR BY FILTER VOTE
    public function filterVote(){
        $doctor=Vote::join('doctor_vote','doctor_vote.vote_id','=','votes.id')->rightJoin('doctors','doctors.id','=','doctor_vote.doctor_id')->select(DB::raw('avg(votes.vote) as media, doctors.id'))->groupBy('doctors.id')->orderByDesc('media')->get();
        $arrayFinale=[];
        foreach ($doctor as $key => $value) {
            $arr=[];
            $arr['media']=$value['media'];
            $tmp=Doctor::where('id',$value['id'])->with('user')->first();
            foreach ($tmp->toArray() as $k => $item){
                $arr[$k]=$item;
            }
            $arrayFinale[]=$arr;
        }

        return response()->json([
            'success' => true,
            'results' => $arrayFinale
        ]);
    }
}
