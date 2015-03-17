<?php
class HomeController extends BaseController {

    public function getIndex() {
	return View::make('home');
    }

    public function postIndex() {

        $id = Input::get('id');
        $userId = Auth::user()->id;

        // item - модель
        //fintorfail - функция движка
        $item = Item::findOrFail($id);

        //если наше ид совпадает с полем записи
        if($item->owner_id == $userId){
            //вызываем метод модели
            $item->mark();
        }

        return Redirect::route('home');
    }

    public function getNew(){
        $tags = DB::table('tags')->lists('name','id');

        return View::make('new', compact('tags'));
    }


    public function postNew(){
        $rules = array('name' => 'required|min:3|max:255');
        $validator = Validator::make(Input::all(), $rules);
        if($validator->fails()){
            return Redirect::route('new')->withErrors($validator);
        }

        $item = new Item;
        $item->name = Input::get('name');
        $item->tag = Input::get('tag');
        $item->owner_id = Auth::user()->id;
        $item->save();

        return Redirect::route('home');
    }

    public function getDelete(Item $task){
        if($task->owner_id == Auth::user()->id){
            $task->delete();
        }

        return Redirect::route('home');
    }

    public function getSend(){
        //$userId = Auth::user()->id;
        $user = Auth::user();
        $items = $user->items()->where('done', '=', '1')->get();

        if(count($items)>0){

            $task = array();

            foreach ($items as $item)
            {
                $task[] = $item->name;
            }
            setlocale(LC_ALL, 'ru_RU.UTF-8');
            $dt = date('d.m.y - H:m', time());
            $data = array(
                'task'  => $task,
                'date' => $dt,
                'name' => $user->name,
                'email' => $user->email
            );

            Mail::send('emails.welcome', $data, function($message)
            {
                $message->from('admin@site.com', 'Site Admin');
                $message->to('nikitati@gmail.com', 'Босс')->subject('Сводка задач!');
            });
            return Redirect::route('home')->with(array('test' => 'Сводка отправлена'));
        }else{
            return Redirect::route('home')->withErrors(array(
                'Нечего отправлять'
            ));
        }
    }

    public function getAdminka(){
        return View::make('admin');
    }

    public function getDown(){
        return View::make('down');
    }

    //обработка скачивания отчета
    public function postDown(){

        $select_date_ot =  Input::get('myDateOt');
        $select_date_do =  Input::get('myDateDo');
        $select_timestamp_ot = strtotime($select_date_ot);
        $select_timestamp_do = strtotime($select_date_do);


        $now = time();
        if(date("m.d.y", $select_timestamp_do) == date("m.d.y", $now)){
            $select_timestamp_do = $now;
        }

        //todo - переделать на выборку только не обработанных записей
        $items = Tag::with('items')->get();

        /*
        $items = DB::table('tags')
                            ->join('items', 'items.tag', '=', 'tags.id')
                            ->join('users', 'items.owner_id', '=', 'users.id')
                            ->select('tags.id as tid', 'tags.name as tname', 'items.*, users.name as user')
                            ->where('items.done', '=', '1')
                            ->get();
        */



        $output = "Сводка задач с {$select_date_ot} по {$select_date_do} \r\n" ;
        foreach ($items as $row) {
            //print_r($row);exit;
            $output .= $row->name ."\r\n";
            foreach($row->items as $item){
                $created_timestamp =  strtotime($item->updated_at);

                if($created_timestamp >=  $select_timestamp_ot && $created_timestamp <= $select_timestamp_do){
                    //выводим в csv
                    $output .= ' ;'. $item->name . ' ;' .  $item->user_name . "\r\n";
                    //также надо добавить обновление поля о том что запись скачана

                    DB::table('items')
                            ->where('id', $item->id)
                            ->update(array('downloaded' => 1));

                }
            }
            $output .= "\r\n";
        }

        $output .= "\r\n\r\n";
        $output .= "Незавершенные задачи \r\n";

        $users_list = DB::table('users')->select('id', 'name')->get();

        foreach ($users_list as $user) {
            $output .= $user->name . "\r\n";

            $nocomp_items = DB::table('items')->select('name')->whereRaw("done = 0 and owner_id = " . $user->id)->get();

            foreach ($nocomp_items as $item) {
                $output .= ' ;'.  $item->name . "\r\n";
            }
        }

        $filename = "svodki_" . date("m.d.y", $select_timestamp_ot) . '_' . date("m.d.y", $select_timestamp_do) . '.csv';

        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        );
        $output = iconv('UTF-8','CP1251',$output);
        return Response::make(rtrim($output, "\n"), 200, $headers);

    }

    //выводим страницу настроек
    public function getSetting(){
        return View::make('setting');
    }

}
