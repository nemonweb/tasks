<?php

class Item extends Eloquent {


    //protected $fillable = array('name', 'tag');
    //protected $guarded = array('id', 'password');

    public function mark(){
        //меняю состояние done на противоположное при обращении в модели item
        $this->done = $this->done ? false : true;
        //сохраняю в бд
        $this->save();
    }

    public function tags(){
        return $this->hasOne('Tag', 'id', 'tag');
    }
    //protected $table = 'my_users';
}