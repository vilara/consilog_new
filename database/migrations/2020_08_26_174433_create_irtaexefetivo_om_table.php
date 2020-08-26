<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtaexefetivoOmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irtaexefetivo_om', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('om_id');
            $table->foreign('om_id')->references('id')->on('oms')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('irtaexefetivo_id');
            $table->foreign('irtaexefetivo_id')->references('id')->on('irtaexefetivos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('efetivo');
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
        Schema::dropIfExists('irtaexefetivo_om');
    }
}
