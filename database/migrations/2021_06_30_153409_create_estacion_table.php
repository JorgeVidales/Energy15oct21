<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstacionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estacion', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idCompania')->unsigned();
            $table->string('cliente', 100)->nullable();
            $table->string('estacion', 250)->nullable();
            $table->string('direccion', 500)->nullable();

            $table->boolean('condicion')->default(1);
            $table->foreign('idCompania')->references('id')->on('cliente');
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
        Schema::dropIfExists('estacion');
    }
}
