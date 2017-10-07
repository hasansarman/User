<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTokensTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('user_tokens', function (Blueprint $table) {
            $table->increments('ID');
            $table->integer('USER_ID')->unsigned();
            $table->string('ACCESS_TOKEN');
            $table->timestamps();

            $table->unique('ACCESS_TOKEN');
            $table->foreign('USER_ID')->references('ID')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::drop('user_tokens');
    }
}
