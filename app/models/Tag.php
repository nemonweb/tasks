<?php

class Tag extends Eloquent {

    public function items()
    {
        return $this->hasMany('Item', 'tag', 'id')
                            ->join('users', 'items.owner_id', '=', 'users.id')
                            ->select('items.*', 'users.name as user_name')
                            ->where('done', '=','1')
                            ->where('downloaded','=','0');
    }
}