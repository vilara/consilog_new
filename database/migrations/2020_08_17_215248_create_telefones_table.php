<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelefonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telefones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_tel_id');
            $table->foreign('tipo_tel_id')->references('id')->on('tipo_tels')->onDelete('cascade')->onUpdate('cascade');
            $table->string('ddd');
            $table->string('numero');
            $table->morphs('telefoneable');
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
        Schema::dropIfExists('telefones');
    }
}
