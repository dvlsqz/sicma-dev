<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtsFilesGalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ots_files_gallery', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('idots');
            $table->string('file_path');
            $table->string('file_name');
            $table->string('description');
            $table->integer('type_manual');
            $table->integer('type_file');
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
        Schema::dropIfExists('ots_files_gallery');
    }
}
