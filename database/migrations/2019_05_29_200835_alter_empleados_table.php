<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEmpleadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empleados', function (Blueprint $table) {
            $table->string('razon_social')->nullable();
            $table->string('cif')->nullable();
            $table->string('horas_dias_contratado')->nullable();
            $table->date('contrato_start')->nullable();
            $table->date('contrato_end')->nullable();
            $table->date('vacaciones_start')->nullable();
            $table->date('vacaciones_end')->nullable();
            $table->integer('poblacion_id')->unsigned()->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->text('vacaciones')->nullable();
            $table->text('festivos')->nullable();
            $table->text('bajas_ausencias')->nullable();
            $table->boolean('libre')->default(false);
            // $table->foreign('poblacion_id')->references('id')->on('poblaciones');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('empleados', function (Blueprint $table) {
            $table->dropColumn([
                'contrato_start',
                'contrato_end',
                'razon_social',
                'cif',
                'poblacion_id',
            ]);
        });
        Schema::enableForeignKeyConstraints();
    }
}
