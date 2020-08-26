<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtaexEfetivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irtaexefetivos', function (Blueprint $table) {
            $table->id();
            $table->string('circulo');
            $table->string('pessoal');
            $table->unsignedBigInteger('postograd_id');
            $table->foreign('postograd_id')->references('id')->on('postograds')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('irtaexcategory_id');
            $table->foreign('irtaexcategory_id')->references('id')->on('irtaexcategories')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('irtaexefetivos');
    }
}
