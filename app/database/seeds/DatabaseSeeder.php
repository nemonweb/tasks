<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
         //запускаем 2 посева - пользователей и записей
		 //$this->call('UsersTableSeeder');
		 //$this->call('ItemsTableSeeder');
        //$this->call('TagsTableSeeder');
	}

}
