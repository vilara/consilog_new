<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name',50);
            $table->string('label', 200);
            $table->timestamps();
        });
        
        Schema::create('permission_roler', function (Blueprint $table) {
            $table->id();
                $table->unsignedBigInteger('permission_id');
                $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
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
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_roler');
    }
}
