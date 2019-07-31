<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDescAtencionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desc_atencions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('cod_aten',20)->nullable();
//----------------------------------SECTOR A
            $table->string('da_cristales',20)->nullable();
            $table->string('da_armazon',20)->nullable();
            $table->string('da_organicos',20)->nullable();
            $table->string('da_tinte',20)->nullable();
            $table->string('da_uv',20)->nullable();
            $table->string('da_pcr',20)->nullable();

//----------------------------------SECTOR B-1
            $table->string('da_lejosODest',20)->nullable();
            $table->string('da_lejosODCil',20)->nullable();
            $table->string('da_lejosODEje',20)->nullable();
            $table->string('da_lejosODDip',20)->nullable();

            $table->string('da_lejosOLest',20)->nullable();
            $table->string('da_lejosOLCil',20)->nullable();
            $table->string('da_lejosOLEje',20)->nullable();
            $table->string('da_lejosOLDip',20)->nullable();

//-----------------------------------SECTOR B-2
            $table->string('da_cercaODest',20)->nullable();
            $table->string('da_cercaODCil',20)->nullable();
            $table->string('da_cercaODEje',20)->nullable();
            $table->string('da_cercaODDip',20)->nullable();

            $table->string('da_cercaOLest',20)->nullable();
            $table->string('da_cercaOLCil',20)->nullable();
            $table->string('da_cercaOLEje',20)->nullable();
            $table->string('da_cercaOLDip',20)->nullable();

        //---------------------------SECTOR C
            $table->string('da_focales',20)->nullable();
            $table->string('da_otros',20)->nullable();
            $table->string('da_alt',20)->nullable();
            $table->string('da_ad',20)->nullable();
            $table->string('da_doctor',20)->nullable();
            $table->string('da_estuche',20)->nullable();
            $table->string('da_observaciones',20)->nullable();

    //-------------------------------DATOS CA
            $table->integer('ca_cod_usu')->nullable();
            $table->string('ca_tipo',20)->nullable();
            $table->dateTime('ca_fecha')->nullable();
            $table->integer('ca_estado')->nullable();
        });
    }
    public function down()
    {
        Schema::dropIfExists('desc_atencions');
    }
}
