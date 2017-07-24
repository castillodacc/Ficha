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
            $table->string('nombre');
            $table->enum('tipo',['diurna', 'nocturna'])->default('diurna');
            $table->string('horas_laborales');
            $table->boolean('horas_extras')->default(FALSE);
            $table->boolean('hora_comida')->default(FALSE);
            $table->boolean('activa')->default(TRUE);
            $table->timestamp('hora_inicio_jornada')->useCurrent();
            $table->timestamp('hora_fin_jornada')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
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
