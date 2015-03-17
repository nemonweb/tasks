<?php

class ItemsTableSeeder extends Seeder{
    public function run(){
        //cначала удаляем все записи
        DB::table('items')->delete();
        //создаем массив с записями
        $items = array(
            array(
                'owner_id' => '1',
                'name' => 'test',
                'done' => false
            ),
            array(
                'owner_id' => '1',
                'name' => 'test 2',
                'done' => true
            ),
            array(
                'owner_id' => '1',
                'name' => 'test 3',
                'done' => false
            )
        );
        //вставляем записи в таблицу item
        DB::table('items')->insert($items);
    }
}