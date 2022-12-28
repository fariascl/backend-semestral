<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('centro_distribucion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("cd_codigo");
            $table->string("cd_direccion");
            $table->string("cd_telefono");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('centro__distribucions');
    }
};
