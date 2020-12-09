<?php

namespace App\Http\Controllers;

use App\User;
use App\Paket;
use App\PaketUser;
use App\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PaketController extends Controller
{
    public function indexAdmin()
    {
        $paket = Paket::join('users', 'pilihan_paket.user_id', '=', 'users.id')->select('pilihan_paket.*', 'users.name')->get();
        return view('paket.indexAdmin', ['data_paket' => $paket]);
    }

    public function indexPetowner()
    {
        $paket = Paket::where('status', 'Available')->get();
        return view('paket.indexPetowner', ['data_paket' => $paket]);
    }

    public function indexPetshop()
    {
        $paket = Paket::get();
        return view('paket.indexPetshop', ['data_paket' => $paket]);
    }

    public function detailAdmin(Paket $paket)
    {
        $datapaket = $paket;
        $data_petshop = User::where('id', $datapaket->user_id)->first();
        return view('paket.paket-show-admin', ['paket' => $paket, 'petshop' => $data_petshop]);
    }

    public function create()
    {
        return view('paket.paket-create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_paket' => 'required|max:30',
                'harga' => 'required|max:15',
                'keterangan' => 'required',
                'status' => 'required'
            ],
            [
                'nama_paket.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_paket.max' => 'Maksimal 30 karakter',
                'harga.max' => 'Maksimal 15 karakter',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'keterangan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'status.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );
        $paket = Paket::create($request->all());
        return redirect()->route('index.paket.petshop')->with('success', 'Paket berhasil ditambahkan');
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
                'keterangan' => 'required',
                'status' => 'required'
            ],
            [
                'nama_paket.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'nama_paket.max' => 'Maksimal 30 karakter',
                'harga.max' => 'Maksimal 15 karakter',
                'harga.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'keterangan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'status.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

        Paket::where('id', $id)->update([
            'nama_paket' => $request->nama_paket,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
            'status' => $request->status
        ]);

        return redirect()->route('index.paket.petshop')->with('success', 'Data Berhasil Disimpan');
    }

    public function show(Paket $paket)
    {
        $datapaket = $paket;
        $data_petshop = User::where('id', $datapaket->user_id)->first();
        return view('paket.paket-show', ['paket' => $paket, 'petshop' => $data_petshop]);
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
                'durasi_pemesanan' => 'required|max:20',
                'tgl_pesan' => 'required'
            ],
            [
                'jenis_hewan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'jenis_hewan.max' => 'Maksimal 30 karakter',
                'durasi_pemesanan.max' => 'Maksimal 20 karakter',
                'durasi_pemesanan.required' => 'Semua Form harap diisi dan tidak boleh kosong',
                'tgl_pesan.required' => 'Semua Form harap diisi dan tidak boleh kosong'
            ]
        );

        $tgl_pesan = $request->tgl_pesan;
        $tgl_selesai = Carbon::createFromFormat('Y-m-d', $tgl_pesan)->addDays($request->durasi_pemesanan);
        $payment_due = Carbon::now()->setTimezone('Asia/Jakarta')->addHours(24);
        $paket = PaketUser::create([
            'user_id' => $request->user_id,
            'paket_id' => $request->paket_id,
            'jenis_hewan' => $request->jenis_hewan,
            'durasi_pemesanan' => $request->durasi_pemesanan,
            'tgl_pesan' => $tgl_pesan,
            'tgl_selesai' => $tgl_selesai,
            'payment_due' => $payment_due
        ]);
        return redirect()->route('index.paket.petowner')->with('success', 'Paket Service berhasil dipesan, segera lakukan pembayaran');
    }

    public function historyPetowner()
    {
        $user_id = auth()->user()->id;
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->where('order.user_id', '=', $user_id)->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id', 'order.status')->get();
        return view('salePaket.historyPetowner', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyPetshop()
    {
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->where('paket.user_id', auth()->user()->id)->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id', 'order.status')->get();
        return view('salePaket.historyPetshop', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyAdmin()
    {
        $history = DB::table('pilihan_paket as paket')->join('ordering_service_packages as order', 'paket.id', '=', 'order.paket_id')->join('users', 'order.user_id', '=', 'users.id')->select('paket.nama_paket', 'order.durasi_pemesanan', 'order.jenis_hewan', 'order.bukti_pembayaran', 'order.id', 'order.status')->get();
        return view('salePaket.historyAdmin', [
            'dataPemesanan' => $history
        ]);
    }

    public function historyPetownerDestroy($id)
    {
        PaketUser::destroy($id);
        return redirect()->back()->with('success', 'Pesanan berhasil dibatalkan');
    }

    public function historyPetownerDetail($id)
    {
        // Carbon::setTestNow('2020-12-07');
        $pemesanan = PaketUser::join('pilihan_paket as pkt', 'pkt.id', '=', 'ordering_service_packages.paket_id')->join('users', 'users.id', '=', 'pkt.user_id')->where('ordering_service_packages.id', $id)->select('ordering_service_packages.*', 'pkt.nama_paket', 'pkt.harga', 'users.name', 'users.alamat')->get();
        // dd($pemesanan);
        return view('salePaket.historyPetowner-detail', [
            'dataPemesanan' => $pemesanan
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
        $pembelian = PaketUser::join('pilihan_paket as pkt', 'pkt.id', '=', 'ordering_service_packages.paket_id')->where('ordering_service_packages.id', $id)->select('ordering_service_packages.*', 'pkt.nama_paket', 'pkt.harga')->get();
        return view('salePaket.historyAdmin-detail', [
            'dataPemesanan' => $pembelian
        ]);
    }

    public function pembayaran($id)
    {
        $pemesanan = PaketUser::join('pilihan_paket as pkt', 'pkt.id', '=', 'ordering_service_packages.paket_id')->where('ordering_service_packages.id', $id)->select('ordering_service_packages.*', 'pkt.nama_paket', 'pkt.harga')->get();
        return view('salePaket.pembayaran', [
            'dataPemesanan' => $pemesanan
        ]);
    }

    public function verifikasiPembayaran(Request $request, $id)
    {
        PaketUser::where('id', $id)->update([
            'status' => $request->status_pembayaran
        ]);

        $data_order = PaketUser::where('id', $id)->first();
        $id_petshop = Paket::where('id', $data_order->paket_id)->value('user_id');
        $data_petshop = User::where('id', $id_petshop)->first();
        $data_petshop->saldo = ($data_petshop->saldo) + ($data_order->nominal * 0.85);
        $data_petshop->update();

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
            'tgl_kirim' => Carbon::now()->setTimeZone('Asia/Jakarta'),
            'status' => 'diterima',
            'nominal' => $request->nominal,
            'bukti_pembayaran' => $bukti_pembayaran
        ]);

        return redirect()->back()->with('success', 'Data pembayaran akan segera diproses');
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
