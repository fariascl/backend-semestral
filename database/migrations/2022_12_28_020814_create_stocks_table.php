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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("scd_id_medicamento"); // FK
            $table->integer("scd_cantidad");
            $table->unsignedBigInteger("scd_centro_dist"); // FK
            $table->foreign('scd_id_medicamento')->references('id')->on('medicamentos');
            $table->foreign('scd_centro_dist')->references('id')->on('centro_distribucion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
};
