<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDprsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Dprs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('partai');
            $table->string('tps');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kabupaten');
            $table->integer('total');
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
        Schema::dropIfExists('Dprs');
    }
}
