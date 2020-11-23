<?php

namespace App\Http\Controllers;

use App\User;
use App\Paket;
use App\PaketUser;
use App\Progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    public function index($id)
    {
        $progress = Progress::where('id_service', $id)->get();
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $paket);
        return view('progress.index', [
            'dataProgress' => $progress,
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function create($id)
    {
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        // dd($pemesanan);
        return view('progress.create', [
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'hari_ke' => 'required|max:10',
                'kondisi_hewan' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'hari_ke.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'kondisi_hewan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'foto.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

        $attr = $request->all();

        if (request()->file('foto')) {
            $foto = request()->file('foto')->store('images/progress', 'public');
        } else {
            $foto = null;
        }

        $attr['foto'] = $foto;

        $progress = Progress::create($attr);

        return redirect()->route('history.paket.petshop')->with('success', 'Progress hewan berhasil ditambahkan');
    }

    public function edit(Progress $progress)
    {
        return view('progress.edit', ['progress' => $progress]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'hari_ke' => 'required|max:10',
                'foto' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'kondisi_hewan' => 'required'
            ],
            [
                'hari_ke.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'hari_ke.max' => 'Maksimal 30 karakter',
                'foto.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'kondisi_hewan.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );
        $foto = request()->file('foto')->store('images/progress', 'public');
        Progress::where('id', $id)->update([
            'hari_ke' => $request->hari_ke,
            'kondisi_hewan' => $request->kondisi_hewan,
            'foto' => $foto
        ]);

        return redirect()->route('history.paket.petshop')->with('success', 'Data Berhasil Disimpan');
    }

    public function destroy($id)
    {
        $data = Progress::find($id);
        $image_path = public_path() . '/storage/' . $data->foto;
        unlink($image_path);
        Progress::destroy($id);
        return redirect()->route('history.paket.petshop')->with('success', 'Progress hewan berhasil dihapus');
    }
}
