<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_generals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodo_id');
            $table->double('activos')->default(0);
            $table->double('activo_corriente')->default(0);
            $table->double('efectivo')->default(0);
            $table->double('cuentas_por_cobrar')->default(0);
            $table->double('inventario')->default(0);
            $table->double('activo_no_corriente')->default(0);
            $table->double('activo_fijo_neto')->default(0);   
            $table->double('pasivos')->default(0);
            $table->double('pasivo_corriente')->default(0);
            $table->double('cuentas_por_pagar')->default(0);   
            $table->double('pasivo_no_corriente')->default(0);       
            $table->double('patrimonio')->default(0);
            $table->double('capital_social')->default(0);
            
            
            $table->foreign('periodo_id')->references('id')->on('periodos')->onDelete('cascade');
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
        Schema::dropIfExists('balance_generals');
    }
}
