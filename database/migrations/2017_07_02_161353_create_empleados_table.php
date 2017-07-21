<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('jornada_id')->unsigned()->nullable();
            $table->integer('cliente_id')->unsigned()->nullable();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('telefono_movil');
            $table->string('correo');
            $table->string('dni')->unique();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jornada_id')->references('id')->on('jornadas');
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
        Schema::dropIfExists('empleados');
    }
}
