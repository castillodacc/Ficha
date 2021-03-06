<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use Carbon\Carbon;

class CreateFichasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('empleado_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->enum('estado', ['en progreso', 'cerrado', 'no laborado'])->default('en progreso');
            $table->timestamp('fecha')->useCurrent();
            $table->string('tiempo_por_trabajar');
            $table->timestamp('hora_inicio')->useCurrent();
            $table->timestamp('hora_fin')->nullable();
            $table->timestamp('hora_inicio_comida')->nullable();
            $table->timestamp('hora_fin_comida')->nullable();
            $table->timestamp('hora_inicio_extras')->nullable();
            $table->timestamp('hora_fin_extras')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('empleado_id')->references('id')->on('empleados');
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
        Schema::dropIfExists('fichas');
    }
}
