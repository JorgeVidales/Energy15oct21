<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaquinasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maquinas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idaceite')->unsigned();
            $table->string('tipoaceite', 250)->nullable();
            $table->string('tipo', 250)->nullable();
            $table->string('marca', 250)->nullable();
            $table->string('modelo', 250)->nullable();
            $table->string('tag', 250)->nullable();
            $table->string('volaceite', 250)->nullable();
            $table->foreign('idaceite')->references('id')->on('aceites');
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
        Schema::dropIfExists('maquinas');
    }
}
