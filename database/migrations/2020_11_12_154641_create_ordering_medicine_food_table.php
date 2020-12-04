<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderingMedicineFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordering_medicine_food', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('produk_id');
            $table->integer('jumlahProduk');
            $table->text('alamat');
            $table->string('noHp', 13);
            $table->text('catatan')->nullable();
            $table->string('no_rek_pengirim', 15)->nullable();
            $table->string('nama_pengirim', 30)->nullable();
            $table->date('tgl_kirim')->nullable();
            $table->integer('nominal')->nullable();
            $table->string('bukti_pembayaran', 100)->nullable();
            $table->string('status', 20)->nullable();
            $table->datetime('payment_due')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('produk_id')->references('id')->on('data_produk')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordering_medicine_food');
    }
}
