<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment_transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('date');
            $table->integer('idequipment');
            $table->integer('idservicegeneral');
            $table->integer('idservice');
            $table->integer('idenvironment');
            $table->text('reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipment_transfers');
    }
}
