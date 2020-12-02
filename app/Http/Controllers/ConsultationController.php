<?php

namespace App\Http\Controllers;

use App\Consultation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function indexPetshop()
    {
        $user_id = auth()->user()->id;

        $consultation = DB::table('Consultation as c')->join('users', 'c.id_penerima', '=', 'users.id')->where('c.id_penerima', '=', $user_id)->select('c.*', 'users.name')->get();

        return view('petshop.indexConsul', ['dataConsultation' => $consultation]);
    }

    public function indexPetowner()
    {
        $user_id = auth()->user()->id;

        $consultation = DB::table('Consultation as c')->join('users', 'c.id_pengirim', '=', 'users.id')->where('c.id_pengirim', '=', $user_id)->select('c.*')->get();

        return view('petowner.indexConsul', ['dataConsultation' => $consultation]);
    }

    public function create()
    {
        $petshop = DB::table('users')->where('id_role', '=', 2)->select('users.*')->get();
        return view('petowner.createConsul', ['dataPetshop' => $petshop]);
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        // $data = $request->all();
        // dd($data, $user_id);
        $konsul = Consultation::create([
            'id_pengirim' => $user_id,
            'id_penerima' => $request->id_penerima,
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('index.consultation.petowner');
    }
}
