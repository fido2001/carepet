<?php

namespace App\Http\Controllers;

use App\DataProduk;
use App\ProdukUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    public function indexPetshop()
    {
        $produk = DataProduk::get();
        return view('produk.indexPetshop', ['data_produk' => $produk]);
    }

    public function indexAdmin()
    {
        $produk = DataProduk::get();
        return view('produk.indexAdmin', ['data_produk' => $produk]);
    }

    public function indexPetowner()
    {
        $produk = DataProduk::get();
        return view('produk.indexPetowner', ['data_produk' => $produk]);
    }

    public function store(Request $request)
    {
        $produk = DataProduk::create($request->all());
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(DataProduk $dataProduk)
    {
        return view('produk.produk-edit', ['dataProduk' => $dataProduk]);
    }

    public function update(Request $request, $id)
    {
        DataProduk::where('id', $id)->update([
            'nama_produk' => $request->nama_produk,
            'stok' => $request->stok,
            'harga' => $request->harga,
            'deskripsi_produk' => $request->deskripsi_produk
        ]);

        return redirect()->route('index.produk.petshop')->with('success', 'Data Berhasil Disimpan');
    }

    public function show(DataProduk $dataProduk)
    {
        return view('produk.produk-show', ['dataProduk' => $dataProduk]);
    }

    public function sale(DataProduk $dataProduk)
    {
        return view('produk.produk-sale', ['dataProduk' => $dataProduk]);
    }

    public function purchase(Request $request)
    {
        $produk = ProdukUser::create($request->all());
        return redirect()->route('index.produk.petowner')->with('success', 'Pemasanan berhasil dipesan, segera lakukan pembayaran');
    }

    public function historyPetowner()
    {
        $user_id = auth()->user()->id;
        $pembelian = ProdukUser::where('user_id', $user_id)->get()->toArray();
        $id_produk = ProdukUser::where('user_id', $user_id)->get('produk_id')->toArray();
        // $produk = DataProduk::where('id', $id_produk)->get();
        $produk = DataProduk::find($id_produk, ['nama_produk', 'harga'])->toArray();
        // dd($user_id, $pembelian, $id_produk, $produk);
        return view('saleProduk.historyPetowner', [
            'dataPembelian' => $pembelian,
            'dataProduk' => $produk
        ]);
    }

    public function historyPetshop()
    {
        $history = DB::table('data_produk as produk')->join('ordering_medicine_food as order', 'produk.id', '=', 'order.produk_id')->join('users', 'order.user_id', '=', 'users.id')->select('produk.nama_produk', 'order.jumlahProduk', 'produk.harga', 'order.bukti_pembayaran', 'order.id', 'order.status_pembayaran')->get();
        // dd($pemesanan, $user_id_produk, $user, $produk);
        return view('saleProduk.historyPetshop', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyAdmin()
    {
        $pemesanan = ProdukUser::get()->toArray();
        $user_id_produk = ProdukUser::get('user_id')->toArray();
        $user = User::where('id', $user_id_produk)->get()->toArray();
        $id_produk = ProdukUser::get('produk_id')->toArray();
        $produk = DataProduk::find($id_produk, ['nama_produk', 'harga'])->toArray();
        // dd($pemesanan, $user_id_produk, $user, $produk);
        $history = DB::table('data_produk as produk')->join('ordering_medicine_food as order', 'produk.id', '=', 'order.produk_id')->join('users', 'order.user_id', '=', 'users.id')->select('produk.nama_produk', 'order.jumlahProduk', 'produk.harga', 'order.bukti_pembayaran', 'order.id', 'order.status_pembayaran')->get();
        return view('saleProduk.historyAdmin', [
            'dataPemesanan' => $pemesanan,
            'dataPetowner' => $user,
            'dataProduk' => $produk
        ]);
    }

    public function historyPetownerDestroy($id)
    {
        $data = ProdukUser::find($id);
        $image_path = public_path() . '/storage/' . $data->foto;
        unlink($image_path);
        ProdukUser::destroy($id);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function historyPetownerDetail($id)
    {
        $pemesanan = ProdukUser::where('id', $id)->get()->toArray();
        $id_produk = ProdukUser::where('id', $id)->get('produk_id')->toArray();
        // $produk = DataProduk::where('id', $id_produk)->get();
        $produk = DataProduk::find($id_produk, ['nama_produk', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $produk);
        return view('saleProduk.historyPetowner-detail', [
            'dataPemesanan' => $pemesanan,
            'dataProduk' => $produk
        ]);
    }

    public function historyPetshopDetail($id)
    {
        $pemesanan = ProdukUser::where('id', $id)->get();
        $id_produk = ProdukUser::where('id', $id)->get('produk_id')->toArray();
        // $produk = DataProduk::where('id', $id_produk)->get();
        $produk = DataProduk::find($id_produk, ['nama_produk', 'harga'])->toArray();
        // dd($pemesanan, $id_paket, $produk);
        return view('saleProduk.historyPetshop-detail', [
            'dataPemesanan' => $pemesanan,
            'dataProduk' => $produk
        ]);
    }

    public function pembayaran($id)
    {
        $pemesanan = ProdukUser::where('id', $id)->get()->toArray();
        $id_produk = ProdukUser::where('id', $id)->get('produk_id')->toArray();
        $produk = DataProduk::find($id_produk, ['nama_produk', 'harga'])->toArray();
        return view('saleProduk.pembayaran', [
            'dataPemesanan' => $pemesanan,
            'dataProduk' => $produk
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        ProdukUser::where('id', $id)->update([
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

        ProdukUser::where('id', $id)->update([
            'no_rek_pengirim' => $request->no_rek_pengirim,
            'nama_pengirim' => $request->nama_pengirim,
            'tgl_kirim' => date('Y-m-d'),
            'bukti_pembayaran' => $bukti_pembayaran
        ]);

        return redirect()->route('history.produk.petowner')->with('success', 'Data pembayaran akan segera kami proses');
    }
}
