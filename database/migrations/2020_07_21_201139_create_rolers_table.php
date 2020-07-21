<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      
        Schema::create('rolers', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('label', 200);
            $table->timestamps();
        });
        
            Schema::create('roler_user', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->unsignedBigInteger('roler_id');
                $table->foreign('roler_id')->references('id')->on('rolers')->onDelete('cascade');
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
        Schema::dropIfExists('rolers');
        Schema::dropIfExists('roler_user');
    }
}
