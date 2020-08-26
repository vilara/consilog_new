<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialOmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_om', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('om_id');
            $table->foreign('om_id')->references('id')->on('oms')->onDelete('cascade')->onUpdate('cascade');
            $table->string('nee');
            $table->foreign('nee')->references('nee')->on('materials')->onDelete('cascade')->onUpdate('cascade');
            $table->string('patrimonio');
            $table->date('inclusao');
            $table->date('validade');
            $table->integer('qtde');
            $table->boolean('sit')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('material_om');
    }
}
