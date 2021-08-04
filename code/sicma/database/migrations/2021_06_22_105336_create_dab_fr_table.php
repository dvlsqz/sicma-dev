<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDabFrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dab_fr', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idmaintenancearea');
            $table->string('no_doc');
            $table->string('accountable');
            $table->string('ibm_accountable');
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
        Schema::dropIfExists('dab_fr');
    }
}
