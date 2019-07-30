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
            $table->integer('tipo_contrato_id')->unsigned()->default(1);
            $table->string('horas_dias_contratado')->nullable();
            $table->date('contrato_start')->nullable();
            $table->date('contrato_end')->nullable();
            $table->integer('empresa_id')->unsigned()->nullable();
            $table->text('vacaciones')->nullable();
            $table->text('festivos')->nullable();
            $table->text('bajas_ausencias')->nullable();
            $table->boolean('libre')->default(false);
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
                'tipo_contrato_id',
                'contrato_start',
                'contrato_end',
                'empresa_id',
                'horas_dias_contratado',
                'vacaciones',
                'festivos',
                'bajas_ausencias',
                'libre',
            ]);
        });
        Schema::enableForeignKeyConstraints();
    }
}
