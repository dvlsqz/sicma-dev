<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToIncomesKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes_kardex', function (Blueprint $table) {
            $table->string('accountable')->after('no_doc');
            $table->string('ibm-accountable')->after('accountable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incomes_kardex', function (Blueprint $table) {
            //
        });
    }
}
