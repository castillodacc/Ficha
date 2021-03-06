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
            // $table->boolean('hereda_permisos')->default(FALSE);
            $table->boolean('crea_admin')->default(FALSE);
            $table->boolean('crea_empleado')->default(FALSE);
            $table->boolean('crea_jornada')->default(FALSE);
            $table->boolean('crea_cliente')->default(FALSE);
            $table->boolean('gestiona_empleado')->default(FALSE);
            $table->boolean('gestiona_admin')->default(FALSE);
            $table->boolean('gestiona_jornada')->default(FALSE);
            $table->boolean('gestiona_cliente')->default(FALSE);
            $table->boolean('genera_reporte')->default(FALSE);
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
