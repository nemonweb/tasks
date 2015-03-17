<?php

class AuthController extends Controller {
    public function getLogin(){
        //возвращаем окно логина
        return View::make('login');
    }

    public function postLogin(){
        //правила для валидатора, расставляем требуемые поля
        $rules = array(
            'email' => array('required', 'email'),
            'password' => 'required',
        );
        //применяем правила ко всем инпутам
        $validator = Validator::make(Input::all(), $rules);
        //если валидатор вернет ошибку - редирект на страницу логина и вывод ошибок
        if($validator->fails()){
            return Redirect::route('login')->withErrors($validator);
        }
        //проверяем авторизацию по полям name и password и если не верно - возвращаем false
        $auth = Auth::attempt(array(

            'email' => Input::get('email'),
            'password' => Input::get('password')

        ), true);

        //если авторизация не проша - редиректим на страницу логина с выводом сообщения
        if(!$auth){
            return Redirect::route('login')->withErrors(array(
                'Такого пользователя нема'
            ));
        }
        //если ошибок нет - редиректим на главную
        return Redirect::route('home');

    }

    public function getRegistration(){
        return View::make('registration');
    }

    public function postRegistration(){
        $rules = array(
            'username' => array('required'),
            'email' => array('required', 'email', 'unique:users'),
            'password'    => array('required', 'min:5'),
        );
        $messages = array(
            'email.email' => 'Please enter a valid E-mail address.',
            'email.required' => 'E-mail address is required.',
            'password.required' => 'Password is required.',
            'password.min' => 'Your password is too short! Min 5 symbols.',
            'email.unique' => 'This E-mail has already been taken.',
        );

        $validation = Validator::make(Input::all(), $rules, $messages);

        if ($validation->fails()) {
            return Redirect::to('registration')->withInput()->withErrors($validation);
        }

        $user = new User;
        $user->name = Input::get('username');
        $user->email = Input::get('email');
        $user->password = Hash::make(Input::get('password'));
        $user->save();

        //Auth::login($user);
        return Redirect::to('login');
    }

    public function getToken(){

        return csrf_token();
    }
}