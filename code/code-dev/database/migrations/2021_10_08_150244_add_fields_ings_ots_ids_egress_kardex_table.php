<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsIngsOtsIdsEgressKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('egress_kardex', function (Blueprint $table) {
            $table->integer('iding7')->after('no_doc')->nullable();
            $table->integer('idot')->after('iding7')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('egress_kardex', function (Blueprint $table) {
            //
        });
    }
}
