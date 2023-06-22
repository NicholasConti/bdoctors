<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function index(){
        $user = auth()->user();
        $message=Message::where('messages.doctor_id', $user->doctor->id)->orderBy('created_at', 'desc')->get();
        return view('doctor.message',compact('message'));
    }
}
