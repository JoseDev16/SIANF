<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 100);
            $table->string('nombre',100);
            $table->unsignedBigInteger('empresa_id')->nullable()->unique();
            $table->unsignedBigInteger('tipo_id')->nullable()->unique();
            $table->integer('padre_id')->nullable();    //Relacion reflexiva de cuenta                        
            $table->timestamps();
            
            $table->foreign('empresa_id')->references('id')->on('empresas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('tipo_id')->references('id')->on('tipo_cuentas')->onUpdate('cascade')->onDelete('cascade');
            
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuentas');
    }
}
