<?php

namespace App\Http\Controllers;

use App\DataProduk;
use App\ProdukUser;
use App\User;
use Illuminate\Http\Request;

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
        // dd($pembelian, $id_produk, $produk);
        return view('sale.historyPetowner', [
            'dataPembelian' => $pembelian,
            'dataProduk' => $produk
        ]);
    }
}
