<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOmdsToComandoOmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comando_om', function (Blueprint $table) {
            $table->tinyInteger('omds') // Nome da coluna
            ->default(0)// Preenchimento não obrigatório
            ->after('comando_id'); // Ordenado após a coluna "password"
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comando_om', function (Blueprint $table) {
            //
        });
    }
}
