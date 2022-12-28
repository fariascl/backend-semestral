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
        Schema::create('traspasos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("tras_cd_origen");
            $table->unsignedBigInteger("tras_cd_destino");
            $table->string("tras_estado", 255);
            $table->foreign('tras_cd_origen')->references('id')->on('centro_distribucion');
            $table->foreign('tras_cd_destino')->references('id')->on('centro_distribucion');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traspasos');
    }
};
