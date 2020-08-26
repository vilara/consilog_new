<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIrtaexOiisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('irtaexoiis', function (Blueprint $table) {
            $table->id();
            $table->string('oii');
            $table->text('tarefa');
            $table->text('condicao');
            $table->text('padraminimo');
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
        Schema::dropIfExists('irtaexoiis');
    }
}
