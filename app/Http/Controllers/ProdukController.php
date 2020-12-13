<?php

namespace App\Http\Controllers;

use App\DataProduk;
use App\ProdukUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProdukController extends Controller
{
    public function indexPetshop()
    {
        $produk = DataProduk::where('user_id', auth()->user()->id)->get();
        return view('produk.indexPetshop', ['data_produk' => $produk]);
    }

    public function indexAdmin()
    {
        $produk = DataProduk::join('users', 'data_produk.user_id', '=', 'users.id')->select('data_produk.*', 'users.name')->get();
        return view('produk.indexAdmin', ['data_produk' => $produk]);
    }

    public function detailAdmin(DataProduk $dataProduk)
    {
        $produk = $dataProduk;
        $data_petshop = User::where('id', $produk->user_id)->first();
        return view('produk.produk-show-admin', ['dataProduk' => $dataProduk, 'petshop' => $data_petshop]);
    }

    public function indexPetowner()
    {
        $produk = DataProduk::where('stok', '>', 0)->get();
        return view('produk.indexPetowner', ['data_produk' => $produk]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_produk' => ['required', 'max:50'],
                'stok' => ['required', 'max:10'],
                'harga' => ['required', 'max:15'],
                'deskripsi_produk' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'nama_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'stok.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'deskripsi_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_produk.max' => 'Maksimal 50 karakter',
                'stok.max' => 'Maksimal 10 karakter',
                'harga.max' => 'Maksimal 15 karakter'
            ]
        );

        if (request()->file('image')) {
            $gambar = request()->file('image')->store("images/produk", "public");
        } else {
            $gambar = null;
        }

        $attr = $request->all();

        $attr['gambar'] = $gambar;

        $produk = DataProduk::create($attr);

        return redirect()->back()->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(DataProduk $dataProduk)
    {
        return view('produk.produk-edit', ['dataProduk' => $dataProduk]);
    }

    public function update(Request $request, DataProduk $dataProduk)
    {
        $request->validate(
            [
                'nama_produk' => ['required', 'max:50'],
                'stok' => ['required', 'max:10'],
                'harga' => ['required', 'max:15'],
                'deskripsi_produk' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,svg|max:2048'
            ],
            [
                'nama_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'stok.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'deskripsi_produk.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_produk.max' => 'Maksimal 50 karakter',
                'stok.max' => 'Maksimal 10 karakter',
                'harga.max' => 'Maksimal 15 karakter'
            ]
        );

        if (request()->file('image')) {
            \Storage::delete($dataProduk->gambar);
            $gambar = request()->file('image')->store("images/artikel", 'public');
        } else {
            $gambar = $dataProduk->gambar;
        }


        $attr = $request->all();

        $attr['gambar'] = $gambar;

        $dataProduk->update($attr);

        return redirect()->route('index.produk.petshop')->with('success', 'Data Berhasil Disimpan');
    }

    public function show(DataProduk $dataProduk)
    {
        $produk = $dataProduk;
        $data_petshop = User::where('id', $produk->user_id)->first();
        return view('produk.produk-show', ['dataProduk' => $dataProduk, 'petshop' => $data_petshop]);
    }

    public function sale(DataProduk $dataProduk)
    {
        $produk = $dataProduk;
        $data_petshop = User::where('id', $produk->user_id)->first();
        return view('produk.produk-sale', ['dataProduk' => $dataProduk, 'petshop' => $data_petshop]);
    }

    public function purchase(Request $request, $id)
    {
        $stok = DataProduk::where('id', $id)->value('stok');
        if ($request->jumlahProduk <= $stok) {
            $request->validate(
                [
                    'jumlahProduk' => ['required'],
                    'noHp' => ['required', 'min:10', 'max:13', 'regex:/^(08)[0-9]*/'],
                    'alamat' => ['required', 'max:50'],
                    'catatan' => ['required', 'max:100'],
                ],
                [
                    'jumlahProduk.required' => 'Semua Form pemesanan harap diisi dan tidak boleh Kosong',
                    'noHp.required' => 'Semua Form pemesanan harap diisi dan tidak boleh Kosong',
                    'alamat.required' => 'Semua Form pemesanan harap diisi dan tidak boleh Kosong',
                    'catatan.required' => 'Semua Form pemesanan harap diisi dan tidak boleh Kosong',
                    'catatan.max' => 'Maksimal 100 karakter',
                    'alamat.max' => 'Maksimal 50 karakter',
                    'noHp.max' => 'Maksimal 13 karakter',
                    'noHp.min' => 'Maksimal 10 karakter',
                    'noHp.regex' => 'Data yang dimasukkan tidak valid'
                ]
            );
            $attr = $request->all();
            $attr['payment_due'] = Carbon::now()->setTimeZone('Asia/Jakarta')->addHours(24);
            // dd($attr);
            $produk = ProdukUser::create($attr);
            return redirect()->route('history.produk.petowner')->with('success', 'Produk berhasil dipesan, segera lakukan pembayaran');
        } else {
            return redirect()->back()->with('warning', 'Jumlah pembelian melebihi stok.');
        }
    }

    public function historyPetowner()
    {
        $user_id = auth()->user()->id;
        $pembelian = DB::table('ordering_medicine_food as ord')->join('data_produk as prd', 'prd.id', '=', 'ord.produk_id')->where('ord.user_id', $user_id)->select('ord.*', 'prd.nama_produk')->get();
        return view('saleProduk.historyPetowner', [
            'dataPembelian' => $pembelian
        ]);
    }

    public function historyPetshop()
    {
        $history = DB::table('data_produk as produk')->join('ordering_medicine_food as order', 'produk.id', '=', 'order.produk_id')->join('users', 'order.user_id', '=', 'users.id')->where('produk.user_id', auth()->user()->id)->select('produk.nama_produk', 'order.jumlahProduk', 'produk.harga', 'order.bukti_pembayaran', 'order.id', 'order.status')->get();
        // dd($pemesanan, $user_id_produk, $user, $produk);
        return view('saleProduk.historyPetshop', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyAdmin()
    {
        $history = DB::table('data_produk as produk')->join('ordering_medicine_food as order', 'produk.id', '=', 'order.produk_id')->join('users', 'order.user_id', '=', 'users.id')->select('produk.nama_produk', 'order.jumlahProduk', 'produk.harga', 'order.bukti_pembayaran', 'order.id', 'order.status')->get();

        return view('saleProduk.historyAdmin', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyAdminDestroy($id)
    {
        ProdukUser::destroy($id);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function historyPetownerDestroy($id)
    {
        ProdukUser::destroy($id);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function historyPetownerDetail($id)
    {
        // Carbon::setTestNow('2020-12-06');
        $pembelian = DB::table('ordering_medicine_food as ord')->join('data_produk as prd', 'prd.id', '=', 'ord.produk_id')->join('users', 'users.id', '=', 'prd.user_id')->where('ord.id', $id)->select('ord.*', 'prd.nama_produk', 'prd.harga', 'users.name')->get();
        // dd($pembelian);
        return view('saleProduk.historyPetowner-detail', [
            'dataPemesanan' => $pembelian
        ]);
    }

    public function historyPetshopDetail($id)
    {
        $pemesanan = ProdukUser::join('data_produk as prd', 'prd.id', '=', 'ordering_medicine_food.produk_id')->where('ordering_medicine_food.id', $id)->select('ordering_medicine_food.*', 'prd.nama_produk', 'prd.harga')->get();
        return view('saleProduk.historyPetshop-detail', [
            'dataPemesanan' => $pemesanan
        ]);
    }

    public function historyAdminDetail($id)
    {
        $order = ProdukUser::where('id', $id)->first();
        if (Carbon::now()->setTimezone('Asia/Jakarta') > $order->payment_due) {
            $order->delete();
            return redirect('admin/historyMedicine')->with('fail', 'Pesanan telah dibatalkan, karena pembayaran tidak dilakukan sebelum waktu batas pembayaran habis.');
        } else {
            $pemesanan = ProdukUser::join('data_produk as prd', 'prd.id', '=', 'ordering_medicine_food.produk_id')->where('ordering_medicine_food.id', $id)->select('ordering_medicine_food.*', 'prd.nama_produk', 'prd.harga')->get();
            return view('saleProduk.historyAdmin-detail', [
                'dataPemesanan' => $pemesanan
            ]);
        }
    }

    public function pembayaran($id)
    {
        $pembelian = DB::table('ordering_medicine_food as ord')->join('data_produk as prd', 'prd.id', '=', 'ord.produk_id')->join('users', 'users.id', '=', 'prd.user_id')->where('ord.id', $id)->select('ord.*', 'prd.nama_produk', 'prd.harga', 'users.name')->get();

        return view('saleProduk.pembayaran', [
            'dataPemesanan' => $pembelian
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        ProdukUser::where('id', $id)->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }

    public function storeResi(Request $request, $id)
    {
        $request->validate(
            [
                'resi' => ['required', 'max:15']
            ],
            [
                'resi.required' => 'Data tidak boleh kosong, harap diisi',
                'resi.max' => 'Maksimal 15 karakter'
            ]
        );
        ProdukUser::where('id', $id)->update([
            'resi' => $request->resi,
            'status' => 'dikirim'
        ]);
        return redirect('/petshop/historyMedicine');
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
            'nominal' => $request->nominal,
            'status' => 'diterima',
            'tgl_kirim' => Carbon::now()->setTimeZone('Asia/Jakarta'),
            'bukti_pembayaran' => $bukti_pembayaran
        ]);

        return redirect('history.produk.petowner')->with('success', 'Data pembayaran akan segera diproses');
    }

    public function verifikasiKedatangan($id)
    {
        $data_order = ProdukUser::where('id', $id)->first();
        $data_order->status = 'pesanan diterima';
        $data_order->update();

        $id_petshop = DataProduk::where('id', $data_order->produk_id)->value('user_id');
        $data_petshop = User::where('id', $id_petshop)->first();
        $data_petshop->saldo = ($data_petshop->saldo) + ($data_order->nominal * 0.85);
        $data_petshop->update();

        return redirect('/petowner/historyMedicine');
    }
}
