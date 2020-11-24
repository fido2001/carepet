<?php

namespace App\Http\Controllers;

use App\User;
use App\Paket;
use App\PaketUser;
use App\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaketController extends Controller
{
    public function indexAdmin()
    {
        $paket = Paket::get();
        return view('paket.indexAdmin', ['data_paket' => $paket]);
    }

    public function indexPetowner()
    {
        $paket = Paket::get();
        return view('paket.indexPetowner', ['data_paket' => $paket]);
    }

    public function indexPetshop()
    {
        $paket = Paket::get();
        return view('paket.indexPetshop', ['data_paket' => $paket]);
    }

    public function create()
    {
        return view('paket.paket-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_paket' => 'required|unique:pilihan_paket|max:30',
                'harga' => 'required|max:15',
                'keterangan' => 'required'
            ],
            [
                'nama_paket.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_paket.max' => 'Maksimal 30 karakter',
                'harga.max' => 'Maksimal 15 karakter',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'keterangan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_paket.unique' => 'Nama paket sudah ada, Silakan ganti'
            ]
        );
        $paket = Paket::create($request->all());
        return redirect()->route('index.paket.admin')->with('success', 'Paket berhasil ditambahkan');
    }

    public function edit(Paket $paket)
    {
        return view('paket.paket-edit', ['paket' => $paket]);
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nama_paket' => 'required|max:30',
                'harga' => 'required|max:15',
                'keterangan' => 'required'
            ],
            [
                'nama_paket.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_paket.max' => 'Maksimal 30 karakter',
                'harga.max' => 'Maksimal 15 karakter',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'keterangan.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

        Paket::where('id', $id)->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('index.paket.admin')->with('success', 'Data Berhasil Disimpan');
    }

    public function show(Paket $paket)
    {
        return view('paket.paket-show', ['paket' => $paket]);
    }

    public function sale(Paket $paket)
    {
        return view('paket.paket-sale', ['paket' => $paket]);
    }

    public function purchase(Request $request)
    {
        $request->validate(
            [
                'jenis_hewan' => 'required|max:30',
                'durasi_pemesanan' => 'required|max:20'
            ],
            [
                'jenis_hewan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'jenis_hewan.max' => 'Maksimal 30 karakter',
                'durasi_pemesanan.max' => 'Maksimal 20 karakter',
                'durasi_pemesanan.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

        $paket = PaketUser::create($request->all());
        return redirect()->route('index.paket.petowner')->with('success', 'Paket berhasil dipesan, segera lakukan pembayaran');
    }

    public function historyPetowner()
    {
        $user_id = auth()->user()->id;
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->where('users.id', '=', $user_id)->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id')->get();
        return view('salePaket.historyPetowner', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyPetshop()
    {
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id', 'order.status_pembayaran')->get();
        return view('salePaket.historyPetshop', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyAdmin()
    {
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id', 'order.status_pembayaran')->get();
        return view('salePaket.historyAdmin', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyPetownerDestroy($id)
    {
        $data = PaketUser::find($id);
        $image_path = public_path() . '/storage/' . $data->foto;
        unlink($image_path);
        PaketUser::destroy($id);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function historyPetownerDetail($id)
    {
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        // $produk = DataProduk::where('id', $id_produk)->get();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $paket);
        return view('salePaket.historyPetowner-detail', [
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function historyPetshopDetail($id)
    {
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $paket);
        return view('salePaket.historyPetshop-detail', [
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function historyAdminDetail($id)
    {
        $pemesanan = PaketUser::where('id', $id)->get();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        return view('salePaket.historyAdmin-detail', [
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function pembayaran($id)
    {
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        return view('salePaket.pembayaran', [
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        PaketUser::where('id', $id)->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);
        return redirect()->back();
    }

    public function storePembayaran(Request $request, $id)
    {
        $request->validate(
            [
                'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,svg|max:2048',
                'nama_pengirim' => 'required|max:30',
                'no_rek_pengirim' => 'required|max:15'
            ],
            [
                'bukti_pembayaran.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_pengirim.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'no_rek_pengirim.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'no_rek_pengirim.max' => 'Maksimal 15 Karakter',
                'nama_pengirim.max' => 'Maksimal 30 Karakter'
            ]
        );

        $bukti_pembayaran = request()->file('bukti_pembayaran')->store('images/bukti', 'public');

        PaketUser::where('id', $id)->update([
            'no_rek_pengirim' => $request->no_rek_pengirim,
            'nama_pengirim' => $request->nama_pengirim,
            'tgl_kirim' => date('Y-m-d'),
            'bukti_pembayaran' => $bukti_pembayaran,
            'status_pembayaran' => 'Belum Diverifikasi',
        ]);

        return redirect()->route('history.paket.petowner')->with('success', 'Data pembayaran akan segera kami proses');
    }

    public function progressPetowner($id)
    {
        $progress = Progress::where('id_service', $id)->get();
        $pemesanan = PaketUser::where('id', $id)->get()->toArray();
        $id_paket = PaketUser::where('id', $id)->get('paket_id')->toArray();
        $paket = Paket::find($id_paket, ['nama_paket', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $paket);
        return view('progress.indexPetowner', [
            'dataProgress' => $progress,
            'dataPemesanan' => $pemesanan,
            'dataPaket' => $paket
        ]);
    }
}
