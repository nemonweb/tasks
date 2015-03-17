<?php
class UserTwoController extends \BaseController {
    public $restful = true;

    //функция получения пользователь и их задач, для админки
    public function index(){

        $userId = Auth::user()->id;
        $user = DB::table('users')->select('name', 'id', 'avatar', 'default_tag')->whereRaw("id = " . $userId )->get();
        return Response::json($user);

    }

    public function update()
    {
        $input = Input::all();
        return Response::json(array(
                    'error' => true,
                    'message' => $input),
                404
        );
    }

    public function create()
    {
        return Response::json('zzz1');
    }
    public function store()
    {
        $input = Input::all();
        $def = $input[0];
        $user = Auth::user();
        $user->default_tag = $def;
        $user->save();

        return Response::json(array(
                'error' => false,
                'message' => 'user updated'),
            200
        );
    }
    public function show($id)
    {
        return Response::json('zzz3');
    }
    public function edit($id)
    {
        return Response::json('zzz4');
    }

    public function destroy($id)
    {
        return Response::json('zzz5');
    }

}