<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexManttoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_mantto', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idproduct');
            $table->integer('idmaintenancearea');
            $table->integer('code_mantto_int');
            $table->text('observations');
            $table->softDeletes();
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
        Schema::dropIfExists('kardex_mantto');
    }
}
