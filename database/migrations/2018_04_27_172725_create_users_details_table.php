<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
	
	  if (!Schema::hasTable('users_details')) {
        Schema::create('users_details', function (Blueprint $table) {
            $table->increments('id');
        });
		
		}
		
		 /**
        | With this steps we can run migration successively,
        | without creating many migration files for same table.
        | This is to make sure that all necessary columns are there,
        | especially when we add columns, renaming columns,
        | and when we have data that we want to preserve.
        */
        Schema::table('users_details', function (Blueprint $table) {

            if (!Schema::hasColumn($table->getTable(), 'name')) {
                $table->string('name', 191)
                ->comment('Email address');
            }

            if (!Schema::hasColumn($table->getTable(), 'phone')) {
                $table->string('phone', 10)
                ->comment('Phone Number');
            }

            if (!Schema::hasColumn($table->getTable(), 'email')) {
                $table->string('email', 100)
                ->comment('Email Address');
            }

            if (!Schema::hasColumn($table->getTable(), 'Gender')) {
                $table->string('gender',10)
                ->comment('User Gender');
            }

            if (!Schema::hasColumn($table->getTable(), 'dateofBirth')) {
                $table->string('dateofBirth',20)
                    ->comment('Date of Birth');
            }

            if (!Schema::hasColumn($table->getTable(), 'biography')) {
                $table->string('biography', 500)
                ->comment('Biography');
            }

            if (!Schema::hasColumn($table->getTable(), 'profilepicture')) {
                $table->string('profilepicture',200)->nullable()
                    ->comment('Profile picture');
            }

            // Always create separate timestamps columns as follow
            if (!Schema::hasColumn($table->getTable(), 'updated_at')) {
                $table->timestamp('updated_at')
                ->comment('Last update timestamp');
            }

            if (!Schema::hasColumn($table->getTable(), 'created_at')) {
                $table->dateTime('created_at')
                ->comment('Creation date and time');
            }
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
