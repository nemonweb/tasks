<?php

class TaskController extends \BaseController {

    public $restful = true;

    //получаем все записи
	public function index(){
        $items = Auth::user()->items;
        return Response::json($items);
	}
	public function create()
	{
		//
	}
	public function store()
	{

        $input = Input::all();
        $item = new Item;
        $item->name = $input['name'];
        $item->tag = $input['tag'];
        $item->owner_id = Auth::user()->id;
        $item->save();

        $tag = Tag::find($item->tag);
        $item->tagname = $tag->name;

        return Response::json($item);
	}
	public function show($id)
	{
		//
	}
	public function edit($id)
	{
		//
	}
	public function update($id)
	{
        $input = Input::all();
        $item = Item::find($input['id']);
        if(is_null($item)){
            return Response::json(array(
                    'error' => true,
                    'message' => 'Todo not found'),
                404
            );
        }

        if ( $input['name'] ){
            $item->name = $input['name'];
        }

        if ( $input['done'] == 0 or $input['done'] == 1 ){
            $item->done = $input['done'];
        }

        $item->save();
        return Response::json(array(
                'error' => false,
                'message' => 'item updated'),
            200
        );

	}
	public function destroy($id)
	{
        Item::destroy($id->id);
	}


}
