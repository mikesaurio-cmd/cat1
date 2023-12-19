<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plantas', function (Blueprint $table) {
            $table->integer('idPlanta')->increment();
            $table->string('nombrePlanta');
            $table->string('contactoEmpresa');
            $table->string('telefonoEmpresa');
            $table->string('correoEmpresa');
            $table->string('dateCreation');
            $table->string('updateCreation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plantas');
    }
}
