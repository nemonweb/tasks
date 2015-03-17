<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{
		$input = Input::only('email');
		$newpass = str_random(8);
		$user = User::where('email', '=', $input['email'])->first();
		if($user){
			$user->password = Hash::make($newpass);
			$user->save();
			/*
			Mail::send('emails.resetpass', array('pass' => $newpass), function($message) {
    				$message->to('nikitati@gmail.com')->subject('Новый пароль на сводках');
			});
			*/
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

			$headers .= 'From: Сводки задач <nikitati@gmail.com>' . "\r\n";
			$headers .= 'Cc: nikitati@gmail.com' . "\r\n";
			$headers .= 'Bcc: nikitati@gmail.com' . "\r\n";

			mail($input ['email'], 'Новый пароль', 'Новый пароль на сводках: ' . $newpass . '<br> http://svodki.tihomirov.me/', $headers);
		}
		/*
		$response = Password::remind(Input::only('email'), function($message) {
        			$message->subject('Click on the link below to reset your password.');
    		});
		switch ($response)
		{

			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::REMINDER_SENT:
				return Redirect::back()->with('status', Lang::get($response));
		}
		*/
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}
