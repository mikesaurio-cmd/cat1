<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNopartesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nopartes', function (Blueprint $table) {
            $table->integer('idNoPartes')->increment;
            $table->string('NoParte');
            $table->string('nombreParte');
            $table->string('descripcion');
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
        Schema::dropIfExists('nopartes');
    }
}
