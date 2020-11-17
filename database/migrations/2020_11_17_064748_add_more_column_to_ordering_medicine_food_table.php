<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnToOrderingMedicineFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordering_medicine_food', function (Blueprint $table) {
            $table->string('no_rek_pengirim', 15)->nullable()->after('noHp');
            $table->string('nama_pengirim', 30)->nullable()->after('no_rek_pengirim');
            $table->date('tgl_kirim')->nullable()->after('nama_pengirim');
            $table->string('bukti_pembayaran', 100)->nullable()->after('tgl_kirim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ordering_medicine_food', function (Blueprint $table) {
            //
        });
    }
}
