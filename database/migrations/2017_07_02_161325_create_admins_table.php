<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('nombre');
            $table->boolean('hereda_permisos');
            $table->boolean('crea_admin');
            $table->boolean('crea_empleado');
            $table->boolean('crea_jornada');
            $table->boolean('gestiona_empleado');
            $table->boolean('gestiona_admin');
            $table->boolean('gestiona_jornada');
            $table->boolean('genera_reporte');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
