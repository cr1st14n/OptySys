<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atencions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('cod_usu',20)->nullable();
            $table->string('cod_clie',20)->nullable();
            $table->integer('aten_precio')->nullable();
            $table->integer('aten_aCuenta')->nullable();
            $table->integer('aten_Saldo')->nullable();
            $table->integer('aten_estadoPago')->nullable();
            $table->date('aten_fecha1')->nullable();
            $table->date('aten_fecha2')->nullable();
            $table->time('aten_hora')->nullable();

            //--------------DATOS CA
            $table->integer('ca_cod_usu')->nullable();
            $table->string('ca_tipo',20)->nullable();
            $table->dateTime('ca_fecha')->nullable();
            $table->integer('ca_estado')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('atencions');
    }
}
