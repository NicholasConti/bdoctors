<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\NewMessage;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:40',
            'surname' => 'required|string|max:40',
            'email' => 'required|email|max:70',
            'text_message' => 'required|string',
            'doctor_id' => 'required|integer|exists:doctors,id'
        ]);
        $data = $request->all();
        $msg = new Message();
        $mail = $msg->create($data);

        Mail::to('info@bdoctors.it')->send(new NewMessage($mail));
        return response()->json([
            'success' => true,
            'results' => $mail
        ]);
    }
}
