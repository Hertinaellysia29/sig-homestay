<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemilikHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemilik_homestays', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id");
            $table->string("nama_depan");
            $table->string("nama_belakang");
            $table->string("no_hp");
            $table->string("alamat");
            $table->string("nama_homestay");
            $table->string("status");
            $table->string("pesan");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemilik_homestays');
    }
}
