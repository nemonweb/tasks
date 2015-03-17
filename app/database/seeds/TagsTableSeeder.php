<?php

class TagsTableSeeder extends Seeder{
    public function run(){
        DB::table('tags')->delete();

        $users = array(
          array('name' => 'Piluli'),
          array('name' => 'Kidstore'),
          array('name' => 'Apteka5'),
          array('name' => 'Onni')
        );

        DB::table('tags')->insert($users);
    }
}