<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('ibm')->unique();
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->integer('role');
            $table->integer('status');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
        DB::table('users')->insert(array(
            'id'=>'1',
            'name'=>'Daniel',
            'lastname'=>'Velasquez',
            'ibm'=>'37732',
            'password' => '$10$OcV45MsAnlnh0dBhH5wD/.EUTfq.T7/ZnGtBSerdK4ZhWyFU2ncnC', 
            'permissions' => '{"dashboard":"true","user_list":"true","user_add":"true","user_edit":"true","user_banned":"true","user_delete":"true","user_reset_password":"true","user_permissions":"true"}', 
            'role' =>'0', 
            'status'=>'1'
        ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
