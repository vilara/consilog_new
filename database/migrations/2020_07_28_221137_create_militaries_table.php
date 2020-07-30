<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMilitariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('militaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('postograd_id');
            $table->foreign('postograd_id')->references('id')->on('postograds')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('situacao', ['a', 'r']);
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('militaries');
        Schema::enableForeignKeyConstraints();
    }
}
