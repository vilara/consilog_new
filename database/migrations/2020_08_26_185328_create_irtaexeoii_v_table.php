<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtaexeoiiVTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irtaexeoii_v', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('v_id');
            $table->foreign('v_id')->references('id')->on('v')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('irtaexoii_id');
            $table->foreign('irtaexoii_id')->references('id')->on('irtaexoiis')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantidade');
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
        Schema::dropIfExists('irtaexeoii_v');
    }
}
