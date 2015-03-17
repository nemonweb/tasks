<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /*
        создаем миграцию - таблицу в бд
    */
	public function up()
	{
		Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('password');
            $table->string('email');
            $table->timestamps();
        });
	}

    /*
        удаляем миграцию - таблицу в бд
    */
	public function down()
	{
		Schema::drop('users');
	}

}
