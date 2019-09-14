<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->string('post_code')->nullable();
            $table->integer('prefecture_code')->nullable();
            $table->string('address')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
