<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressHewanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress_hewan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_service');
            $table->integer('hari_ke');
            $table->text('kondisi_hewan');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('id_service')->references('id')->on('ordering_service_packages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress_hewan');
    }
}
