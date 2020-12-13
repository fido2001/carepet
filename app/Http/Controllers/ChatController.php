<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Consultation;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ChatController extends Controller
{
    public function indexPetshop($id)
    {
        // $user_id = $user_id = auth()->user()->id;

        $consultation = Consultation::where('id', '=', $id)->get();

        $chat = Chat::join('consultation', 'consultation.id', '=', 'chat.id_konsultasi')->join('users', 'users.id', '=', 'chat.id_pengirim')->where('chat.id_konsultasi', '=', $id)->select('chat.*', 'users.name')->get();

        // $chat = DB::table('chat')->join('consultation as cs', 'chat.id_konsultasi', '=', 'cs.id')->where('chat.id_konsultasi', '=', $id)->select('chat.*, cs.*')->get();

        return view('petshop.chat', [
            'dataConsultation' => $consultation,
            'dataChat' => $chat
        ]);
    }

    public function indexPetowner($id)
    {
        // $user_id = $user_id = auth()->user()->id;

        $consultation = Consultation::where('id', '=', $id)->get();

        $chat = Chat::join('consultation', 'consultation.id', '=', 'chat.id_konsultasi')->join('users', 'users.id', '=', 'chat.id_pengirim')->where('chat.id_konsultasi', '=', $id)->select('chat.*', 'users.name')->get();

        // $chat = DB::table('chat')->join('consultation as cs', 'chat.id_konsultasi', '=', 'cs.id')->where('chat.id_konsultasi', '=', $id)->select('chat.*, cs.*')->get();

        return view('petowner.chat', [
            'dataConsultation' => $consultation,
            'dataChat' => $chat
        ]);
    }

    public function store(Request $request)
    {
        request()->validate(
            [
                'balasan' => 'required'
            ],
            [
                'balasan.required' => 'Chat tidak boleh kosong'
            ]
        );

        $user_id = auth()->user()->id;

        $chat = Chat::create([
            'id_pengirim' => $user_id,
            'id_konsultasi' => $request->id_konsultasi,
            'balasan' => $request->balasan,
            'tanggal' => Carbon::now()->setTimeZone('Asia/Jakarta'),
            'waktu' => Carbon::now()->setTimeZone('Asia/Jakarta')
        ]);

        return redirect()->back();
    }
}
