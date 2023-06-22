<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:40',
            'surname' => 'required|string|max:40',
            'email' => 'required|email|max:70',
            'text_message' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id'
        ]);
        $data=$request->all();
        $newMessage=new Message();
        $newMessage->create($data);

        return response()->json([
            'success' => true,
            'results' => $data
        ]);
    }
}
