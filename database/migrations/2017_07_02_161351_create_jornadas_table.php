<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJornadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jornadas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->string('nombre');
            $table->enum('tipo',['diurna', 'nocturna'])->default('diurna');
            $table->smallInteger('horas_laborales')->unsigned()->default(8);
            $table->boolean('horas_extras')->default(false);
            $table->boolean('activa')->default(TRUE);
            $table->timestamp('hora_inicio_jornada')->useCurrent();
            $table->timestamp('hora_fin_jornada')->useCurrent();
            $table->timestamp('hora_inicio_comida')->nullable();
            $table->timestamp('hora_fin_comida')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jornadas');
    }
}
