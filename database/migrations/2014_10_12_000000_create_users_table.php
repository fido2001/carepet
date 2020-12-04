<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_role');
            $table->string('name');
            $table->string('username', 25);
            $table->string('email')->unique();
            $table->string('noHp', 13);
            $table->string('password');
            $table->text('alamat');
            $table->decimal('saldo', 12, 0)->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();

            $table->foreign('id_role')->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
