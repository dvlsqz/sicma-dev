<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngs7Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ings7', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('managed');
            $table->string('administrative_key');
            $table->integer('idservice');
            $table->string('correlative');
            $table->text('type_work')->nullable();
            $table->text('area_work')->nullable();
            $table->integer('buy_materials')->nullable();
            $table->integer('hire_jobs')->nullable();
            $table->text('description');
            $table->integer('idapplicant');
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
        Schema::dropIfExists('ings7');
    }
}
