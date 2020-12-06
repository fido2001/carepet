<?php

namespace App\Http\Controllers;

use App\User;
use App\Withdrawal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WithdrawalController extends Controller
{
    public function index()
    {
        $saldo = User::where('id', auth()->user()->id)->value('saldo');
        $petshop = User::where('id', auth()->user()->id)->first();
        $withdrawal = Withdrawal::where('id_petshop', $petshop->id)->get();

        return view('petshop.withdrawal', compact('saldo', 'withdrawal'));
    }

    public function indexAdmin()
    {
        $withdrawal = Withdrawal::all();

        return view('admin.withdrawal', compact('withdrawal'));
    }

    public function create()
    {
        $saldo = User::where('id', auth()->user()->id)->value('saldo');

        return view('petshop.withdrawal-create', compact('saldo'));
    }

    public function store(Request $request)
    {
        $petshop = User::where('id', auth()->user()->id)->first();

        if ($request->jml_penarikan <= $petshop->saldo) {
            $withdraw = Withdrawal::create([
                'id_petshop' => auth()->user()->id,
                'tanggal_pengajuan' => Carbon::now()->setTimezone('Asia/Jakarta'),
                'jml_penarikan' => $request->jml_penarikan,
                'bank' => $request->bank,
                'no_rekening' => $request->no_rekening,
                'nama_rekening' => $request->nama_rekening,
                'status' => 'diproses'
            ]);

            $petshop->saldo = $petshop->saldo - $request->jml_penarikan;
            $petshop->update();

            return redirect('petshop/withdrawal')->with('success', 'Pengajuan penarikan dana anda sedang diproses. Terima Kasih');
        } else {
            return redirect('/petshop/withdrawal')->with('fail', 'Saldo anda tidak mencukupi!');
        }
    }

    public function show($id)
    {
        $petshop = User::where('id', auth()->user()->id)->first();
        $withdrawal = Withdrawal::where('id_petshop', $petshop->id)->where('id', $id)->first();

        return view('petshop.withdrawal-show', compact('withdrawal'));
    }

    public function showAdmin($id)
    {
        $withdrawal = Withdrawal::where('id', $id)->first();

        return view('admin.withdrawal-show', compact('withdrawal'));
    }

    public function storeBukti(Request $request, $id)
    {
        $request->validate(
            [
                'bukti' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
            ],
            [
                'bukti.required' => 'Semua Form harap diisi dan tidak boleh kosong',
            ]
        );

        $bukti = request()->file('bukti')->store('images/bukti', 'public');

        Withdrawal::where('id', $id)->update([
            'status' => 'dicairkan',
            'tanggal_pencairan' => Carbon::now()->setTimezone('Asia/Jakarta'),
            'bukti' => $bukti
        ]);

        return redirect()->back();
    }
}
