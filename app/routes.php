<?php

Route::bind('task', function($value, $route){
    return Item::where('id', $value)->first();
});

Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/history', array('as' => 'history', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/setting', array('as' => 'setting', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/adminka', array('as' => 'adminka', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/down', array('as' => 'down', 'uses' => 'HomeController@getIndex'))->before('auth');


Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('/login', array('uses' => 'AuthController@postLogin'))->before('csrf');

Route::get('/remind', array('uses' => 'RemindersController@getRemind'))->before('guest');
Route::post('/remind', array('uses' => 'RemindersController@postRemind'))->before('guest');

Route::get('/registration', array('as' => 'rega', 'uses' => 'AuthController@getRegistration'))->before('guest');
Route::post('/registration', array('uses' => 'AuthController@postRegistration'))->before('csrf');

Route::get('/auth/csrf_token', array('uses' => 'AuthController@getToken'))->before('auth');


Route::group(array('prefix' => 'api', 'before' => 'csrfJson'), function() {

    Route::resource('task', 'TaskController',
        array('only' => array('index', 'store', 'destroy', 'update')));

    Route::resource('tag', 'TagController',
        array('only' => array('index')));

    Route::resource('user', 'UserController',
        array('only' => array('index')));

    Route::resource('history', 'HistoryController',
        array('only' => array('index')));

    Route::resource('usertwo', 'UserTwoController',
        array('only' => array('index', 'store', 'destroy', 'update')));
});



Route::post('/down', array('uses' => 'HomeController@postDown'))->before('auth');

//Route::get('/down', array('as' => 'down', 'uses' => 'HomeController@getDown'))->before('auth');
//Route::get('/adminka', array('as' => 'adminka', 'uses' => 'HomeController@getAdminka'))->before('auth');
//Route::get('/setting', array('as' => 'setting', 'uses' => 'HomeController@getSetting'))->before('auth');
//Route::get('/new', array('as' => 'new', 'uses' => 'HomeController@getNew'));
//Route::post('/new', array('uses' => 'HomeController@postNew'))->before('csrf');
//Route::get('/delete/{task}', array('as' => 'delete', 'uses' => 'HomeController@getDelete'));
//Route::get('/send', array('as' => 'send', 'uses' => 'HomeController@getSend'));
//Route::post('/', array('uses' => 'HomeController@PostIndex'))->before('csrf');

Route::get('/testing', function(){

    mail('nikitati@gmail.com', 'test2', 'test2');
}
)->before('auth');

