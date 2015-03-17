<?php

class TagController extends \BaseController {

    public $restful = true;

    //получаем все записи
    public function index(){
            $tags = DB::table('tags')->select('name', 'id')->get();
            return Response::json($tags);
    }



}
