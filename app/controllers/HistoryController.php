<?php

class HistoryController extends \BaseController {

    public $restful = true;

    //получаем все записи
    public function index(){
            $items = Auth::user()->itemsOld;
            return Response::json($items);
    }



}
