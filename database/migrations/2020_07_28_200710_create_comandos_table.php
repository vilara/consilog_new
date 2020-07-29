<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comandos', function (Blueprint $table) {
            $table->id();
            $table->string('nomeCmdo');
            $table->string('siglaCmdo');
            $table->string('codomOm');
            $table->string('codugOm');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comandos');
    }
}
