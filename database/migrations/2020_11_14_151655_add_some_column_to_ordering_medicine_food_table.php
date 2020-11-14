<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColumnToOrderingMedicineFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ordering_medicine_food', function (Blueprint $table) {
            $table->integer('jumlahProduk')->after('produk_id');
            $table->text('alamat')->after('jumlahProduk');
            $table->string('noHp', 13)->after('alamat');
            $table->text('catatan')->after('alamat')->nullable();
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
