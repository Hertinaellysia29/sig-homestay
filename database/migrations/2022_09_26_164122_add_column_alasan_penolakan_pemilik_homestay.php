<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAlasanPenolakanPemilikHomestay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('pemilik_homestays', function (Blueprint $table) {
            $table->text('alasan_penolakan')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pemilik_homestays', function (Blueprint $table) {
            $table->dropColumn('alasan_penolakan');
        });
    }
}