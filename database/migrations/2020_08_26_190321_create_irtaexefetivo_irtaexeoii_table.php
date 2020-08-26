<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtaexefetivoIrtaexeoiiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irtaexefetivo_irtaexoii', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('irtaexefetivo_id');
            $table->foreign('irtaexefetivo_id')->references('id')->on('irtaexefetivos')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('irtaexoii_id');
            $table->foreign('irtaexoii_id')->references('id')->on('irtaexoiis')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('tipo')->nullable();
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
        Schema::dropIfExists('irtaexefetivo_irtaexoii');
    }
}
