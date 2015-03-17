<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;




class User extends Eloquent implements UserInterface, RemindableInterface {


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    protected $fillable = array('email','password');

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    public function items(){
        //функция Eloquent hasMany - взаимоотношения. Item - имя модели. owner_id - поле в таблице
        return $this->hasMany('Item', 'owner_id' )
        ->join('tags', 'items.tag', '=', 'tags.id')
        ->select('items.*', 'tags.name as tagname')
        ->whereRaw('(items.done = 1 and items.downloaded = 1) != 1');
    }

    public function itemsOld(){
        //функция Eloquent hasMany - взаимоотношения. Item - имя модели. owner_id - поле в таблице
        return $this->hasMany('Item', 'owner_id' )
        ->join('tags', 'items.tag', '=', 'tags.id')
        ->select(DB::raw('items.*, tags.name as tagname, UNIX_TIMESTAMP(items.updated_at) as unix'))
        ->whereRaw('items.done = 1')->orderBy('updated_at', 'desc');
    }

    /**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany('Role', 'users_roles');
    }

    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }

    /*
    private function getIdInArray($array, $term)
    {
        foreach ($array as $key => $value) {
            if ($value['name'] == $term) {
                return $value['id'];
            }
        }

        //throw new UnexpectedValueException;
    }

    public function makeEmployee($title)
    {
        $assigned_roles = array();

        $roles = Role::all()->toArray();

        $test = $this->getIdInArray($roles, 'user');
        print_r($test);
        exit;

        $this->roles()->attach($assigned_roles);
    }
    */

}