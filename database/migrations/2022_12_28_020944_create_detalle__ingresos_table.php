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
        Schema::create('detalle_ingresos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger("id_medicamento");
            $table->integer("det_ing_cantidad");
            $table->unsignedBigInteger("det_ingreso_id");
            $table->foreign('id_medicamento')->references('id')->on('medicamentos');
            $table->foreign('det_ingreso_id')->references('id')->on('ingresos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle__ingresos');
    }
};
