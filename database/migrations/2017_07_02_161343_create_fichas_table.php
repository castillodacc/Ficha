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
            $table->enum('estado',['abierta', 'cerrada', 'desconocido'])->default('abierta');
            $table->date('fecha')->default(Carbon::now());
            $table->timestamp('hora_inicio')->useCurrent();
            $table->timestamp('hora_fin')->nullable();
            $table->smallInteger('horas_extras')->nullable()->default(0);
            $table->text('observaciones')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('empleado_id')
                ->references('id')->on('empleados')
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
        Schema::dropIfExists('fichas');
    }
}
