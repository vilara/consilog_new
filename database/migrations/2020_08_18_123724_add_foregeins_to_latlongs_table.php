<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForegeinsToLatlongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('latlongs', function (Blueprint $table) {
            $table->unsignedBigInteger('endereco_id')->after('id');
            $table->foreign('endereco_id')->references('id')->on('enderecos')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('latlongs', function (Blueprint $table) {
            //
        });
    }
}
