<?php

/**
 * Part of the Sentinel package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Sentinel
 * @version    2.0.12
 * @author     Cartalyst LLC
 * @license    BSD License (3-clause)
 * @copyright  (c) 2011-2015, Cartalyst LLC
 * @link       http://cartalyst.com
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrationCartalystSentinel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('USER_ID')->unsigned();
            $table->string('CODE');
            $table->boolean('COMPLETED')->default(0);
            $table->timestamp('COMPLETED_AT')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('persistences', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('USER_ID')->unsigned();
            $table->string('CODE');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('CODE');
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('USER_ID')->unsigned();
            $table->string('CODE');
            $table->boolean('COMPLETED')->default(0);
            $table->timestamp('COMPLETED_AT')->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('SLUG');
            $table->string('NAME');
            $table->text('PERMISSIONS')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('SLUG');
        });

        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('USER_ID')->unsigned();
            $table->integer('ROLE_ID')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['USER_ID', 'ROLE_ID']);
        });

        Schema::create('throttle', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('USER_ID')->unsigned()->nullable();
            $table->string('TYPE');
            $table->string('IP')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('USER_ID');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('ID');
            $table->string('EMAIL');
            $table->string('PASSWORD');
            $table->text('PERMISSIONS')->nullable();
            $table->timestamp('LAST_LOGIN')->nullable();
            $table->string('FIRST_NAME')->nullable();
            $table->string('LAST_NAME')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('EMAIL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('roles');
        Schema::drop('role_users');
        Schema::drop('throttle');
        Schema::drop('users');
    }
}
