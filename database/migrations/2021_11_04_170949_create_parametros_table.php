<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParametrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parametros', function (Blueprint $table) {
            $table->id();
            $table->string('parametro', 100);
            $table->double('min')->nullable();
            $table->double('max')->nullable();
            $table->double('valor')->nullable();
            $table->string('individual')->nullable();

            //Estos campos se refieren a los mensajes personalizados que el ing quiere
            $table->string('mayor',500)->nullable();
            $table->string('entre',500)->nullable();
            $table->string('menor',500)->nullable();            
            
            $table->unsignedBigInteger('tipo_id');
            $table->foreign('tipo_id')->references('id')->on('tipo_parametros')->onDelete('cascade');
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
        Schema::dropIfExists('parametros');
    }
}
