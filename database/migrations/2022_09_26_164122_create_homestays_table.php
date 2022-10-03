<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomestaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homestays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('desa_id');
            $table->foreignId('user_id');
            $table->string('nama');
            $table->string('nama_pemilik');
            $table->string('no_hp');
            $table->text('deskripsi');
            $table->integer('harga')->nullable();
            $table->text('fasilitas');
            $table->string('foto');
            $table->string('alamat_detail');
            $table->string('koordinat_lokasi');
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
        Schema::dropIfExists('homestays');
    }
}
