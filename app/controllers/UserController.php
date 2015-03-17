<?php
class UserController extends \BaseController {
    public $restful = true;

    //функция получения пользователь и их задач, для админки
    public function index(){
    $users = DB::table('users')->select('name', 'id', 'avatar')->get();
    $full_list = array();
    foreach ($users as $user) {
        //$items = DB::table('items')->select('name', 'done', 'created_at')->whereRaw("downloaded = 0 and owner_id = " . $user->id)->orderBy('updated_at', 'desc')->get();
        $items = DB::table('items')->select('name', 'done', 'created_at', 'updated_at')->whereRaw("downloaded = 0 and owner_id = " . $user->id)->orderBy('updated_at', 'desc')->get();

        $return_user = array();
        $return_user['name'] = $user->name;
        if(is_null($user->avatar)){
            $return_user['images'] = 'default.png';
        }else{
            $return_user['images'] = $user->avatar;
        }

        $return_user['tasks'] = $items;
        //получаем последнюю активность
        //$return_user['lastactive'] = $items[0]->updated_at;

        $full_list[] = $return_user;
    }
    return Response::json($full_list);
    }

}