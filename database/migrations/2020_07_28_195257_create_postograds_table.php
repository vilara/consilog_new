<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostogradsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postograds', function (Blueprint $table) {
            $table->id();
            $table->string('nomePg');
            $table->string('siglaPg');
            $table->integer('ordemPg');
            $table->string('circuloPg');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postograds');
    }
}
