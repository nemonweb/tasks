<?php

class Role extends Eloquent {
    public $timestamps = false;

    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('User', 'users_roles');
    }
}