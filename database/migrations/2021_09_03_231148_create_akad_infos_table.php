<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkadInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akad_infos', function (Blueprint $table) {
            // _2 = pihak ke 2
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nomor_akad');
            $table->string('nama');
            $table->string('nik');
            $table->string('alamat');
            $table->string('nama_2');
            $table->string('nik_2');
            $table->string('alamat_2');
            $table->string('ket');
            $table->string('perjanjian');
            $table->string('jangka_waktu');
            $table->string('tempat_tanggal');
            $table->string('nominal_jasa');
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
        Schema::dropIfExists('akad_infos');
    }
}
