<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderingServicePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordering_service_packages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('paket_id');
            $table->string('jenis_hewan', 30);
            $table->bigInteger('durasi_pemesanan');
            $table->datetime('tgl_pesan')->nullable();
            $table->datetime('tgl_selesai')->nullable();
            $table->string('no_rek_pengirim', 15)->nullable();
            $table->string('nama_pengirim', 30)->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('bukti_pembayaran', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->datetime('payment_due')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('paket_id')->references('id')->on('pilihan_paket')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordering_service_packages');
    }
}
