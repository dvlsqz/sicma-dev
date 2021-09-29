<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ots', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('correlative');
            $table->integer('idmaintenancearea');
            $table->date('date_request');
            $table->integer('type_work');
            $table->integer('priority');
            $table->text('specify_job');
            $table->integer('idapplicant');
            $table->integer('idapproval');
            $table->integer('status');
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
        Schema::dropIfExists('ots');
    }
}
