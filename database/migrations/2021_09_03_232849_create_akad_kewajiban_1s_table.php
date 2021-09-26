<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkadKewajiban1sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akad_kewajiban_1s', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nomor_akad');
            $table->string('urutan');
            $table->string('kewajiban');
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
        Schema::dropIfExists('akad_kewajiban_1s');
    }
}
