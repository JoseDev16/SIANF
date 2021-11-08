<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstadoResultadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estado_resultados', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodo_id')->unique();
            $table->double('ventas_netas');
            $table->double('utilidad_bruta');
            $table->double('utilidad_operativa');
            $table->double('utilidad_antes_de_i');
            $table->double('impuestos');
            $table->double('utilidad_neta');

            $table->double('gastos_ventas');
            $table->double('gastos_administracion');
            $table->double('gastos_financieros');
            $table->double('intereses');

            //$table->double('ventas');
            //$table->double('devolucion_ventas');
            //$table->double('descuento_ventas');
            $table->double('costo_ventas');
            //$table->double('gastos_operacion');
            //$table->double('otros_ingresos');
            //$table->double('otros_gastos');
            $table->timestamps();

            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estado_resultados');
    }
}
