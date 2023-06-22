<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Vote;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:40',
            'surname' => 'required|string|max:40',
            'email' => 'required|email|max:70',
            'text_review' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id',
            'vote' => 'required|integer|exists:votes,id'
        ]);
        $data=$request->all();
        $newReview=new Review();
        $newReview->create($data);
        $vote=Vote::find($data['vote']);
        $vote->doctors()->attach($data['doctor_id']);

        return response()->json([
            'success' => true,
            'results' => $data
        ]);
    }
}
