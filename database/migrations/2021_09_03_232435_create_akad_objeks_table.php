<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkadObjeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('akad_objeks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('nomor_akad');
            $table->integer('urutan');
            $table->string('objek_perjanjian');
            $table->string('subjek_perjanjian');
            $table->text('ket_objek');
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
        Schema::dropIfExists('akad_objeks');
    }
}
