<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtsAssignmentsPersonalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ots_assignments_personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type_personal');
            $table->string('company');
            $table->string('name');
            $table->string('area');
            $table->date('date');
            $table->time('hour');
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
        Schema::dropIfExists('ots_assignments_personal');
    }
}
