<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnsToEgressKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('egress_kardex', function (Blueprint $table) {
            $table->dropColumn('accountable');
            $table->dropColumn('ibm_accountable');
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
