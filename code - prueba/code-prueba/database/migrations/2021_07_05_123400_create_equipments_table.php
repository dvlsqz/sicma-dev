<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idmaintenancearea');
            $table->string('code');
            $table->string('name');
            $table->string('brand');
            $table->string('model');
            $table->string('serie');
            $table->string('no_bien');
            $table->integer('year_warranty');
            $table->date('date_instalaction');
            $table->text('features');
            $table->text('description');
            $table->integer('status');
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
        Schema::dropIfExists('equipments');
    }
}
