<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSiafOcToIncomesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('incomes_products', function (Blueprint $table) {
            $table->string('serie_doc')->after('type_doc')->nullable();
            $table->string('no_siaf')->after('serie_doc')->nullable();
            $table->string('no_oc')->after('no_siaf')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('incomes_products', function (Blueprint $table) {
            //
        });
    }
}
