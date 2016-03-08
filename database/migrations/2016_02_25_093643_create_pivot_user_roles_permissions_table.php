<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePivotUserRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function(Blueprint $table) {

            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->primary(['user_id', 'role_id']);

        });

        Schema::create('permission_role', function(Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('permission_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->primary(['permission_id', 'role_id']);

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('role_user');
        Schema::drop('permission_role');
    }
}
