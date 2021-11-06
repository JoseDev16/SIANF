<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromedioRatiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promedio_ratios', function (Blueprint $table) {
            $table->id();
            $table->string('valor_promedio',100);
            $table->unsignedBigInteger('parametro_id');            
            $table->unsignedBigInteger('sector_id');            
            $table->timestamps();

            $table->foreign('parametro_id')->references('id')->on('parametros')->onDelete('cascade');
            $table->foreign('sector_id')->references('id')->on('sectors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promedio_ratios');
    }
}
