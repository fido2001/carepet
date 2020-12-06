<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_petshop');
            $table->dateTime('tanggal_pengajuan');
            $table->decimal('jml_penarikan', 16, 0);
            $table->string('bank',);
            $table->string('no_rekening', 16);
            $table->string('nama_rekening', 100);
            $table->string('status', 20);
            $table->dateTime('tanggal_pencairan')->nullable();
            $table->string('bukti', 100)->nullable();
            $table->timestamps();

            $table->foreign('id_petshop')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('withdrawals');
    }
}
