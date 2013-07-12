<?php

class UserController extends BaseController
{
	public $restful = true;

	public function __construct()
	{
		//Check CSRF token on POST
		//$this->beforeFilter('csrf', array('on' => 'post'));

		//Enable the throttler. [I am not sure about this...]
		// Get the Throttle Provider
		//$throttleProvider = Sentry::getThrottleProvider();

		// Enable the Throttling Feature
		//$throttleProvider->enable();
	}
	public function getIndex(){
		return '<h1>Users index<h1>';
	}

	public function getLogin(){
		return View::make('user.login')
			->with('title', 'Login');
	}

	public function postLogin(){
		$input = [
			'email' 		=> Binput::get('email'),
			'password' 		=> Binput::get('password'),
			'rememberme'	=> Binput::get('rememberme'),
		];
		return View::make('temp')
			->with('input', $input);
	}

	// public function postLogin(){
	// 	$input = [
	// 		'email' 		=> Binput::get('email'),
	// 		'password' 		=> Binput::get('password'),
	// 		'rememberme'	=> Binput::get('rememberme'),
	// 	];
	// 	$rules = [
	// 		'email' 	=> 'required|min:4|max:32|email',
	// 		'password' 	=> 'required|min:6',
	// 	];
	// 	$v = Validator::make($input, $rules);

	// 	if($v->fails()){
	// 		return Redirect::to('user/login')->withErrors($v)->withInput();
	// 	}else{
	// 		try
	// 		{
	// 			//Check for suspension or banned status
	// 			$user = Sentry::getUserProvider()->findByLogin($input['email']);
	// 			$throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
	// 			$throttle->check();

	// 			// Set login credentials
	// 			$credentials = array(
	// 				'email' => $input['email'],
	// 				'password' => $input['password']
	// 			);

	// 			// Try to authenticate the user
	// 			$user = Sentry::authenticate($credentials, $input['rememberMe']);

	// 		}
	// 		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	// 		{
	// 			// Sometimes a user is found, however hashed credentials do
	// 			// not match. Therefore a user technically doesn't exist
	// 			// by those credentials. Check the error message returned
	// 			// for more information.
	// 			Session::flash('error', 'Invalid username or password.' );
	// 			return Redirect::to('users/login')->withErrors($v)->withInput();
	// 		}
	// 		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
	// 		{
	// 			Session::flash('error', 'You have not yet activated this account.');
	// 			return Redirect::to('users/login')->withErrors($v)->withInput();
	// 		}

	// 		// The following is only required if throttle is enabled
	// 		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
	// 		{
	// 			$time = $throttle->getSuspensionTime();
	// 			Session::flash('error', "Your account has been suspended for $time minutes.");
	// 			return Redirect::to('users/login')->withErrors($v)->withInput();
	// 		}
	// 		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
	// 		{
	// 			Session::flash('error', 'You have been banned.');
	// 			return Redirect::to('users/login')->withErrors($v)->withInput();
	// 		}

	// 		//Login was succesful.
	// 		return Redirect::route('home');
	// 	}
	// }

	public function getLogout(){
		Sentry::logout();
		return Redirect::to('/');
	}

	public function getRegister(){
		return View::make('user.register')
			->with('title', 'Registration');
	}
	public function postRegister(){
		Validator::resolver(function($translator, $data, $rules, $messages)
		{
		    return new CustomValidator($translator, $data, $rules, $messages);
		});
		$input = [
			'first_name' 			=> Binput::get('first_name'),
			'last_name' 			=> Binput::get('last_name'),
			'dob' 					=> Binput::get('dob'),
			'username' 				=> Binput::get('username'),
			'mcname' 				=> Binput::get('mcname'),
			'email' 				=> Binput::get('email'),
			'email_confirmation' 	=> Binput::get('email_confirmation'),
			'password' 				=> Binput::get('password'),
			'password_confirmation' => Binput::get('password_confirmation')
		];
		$rules = [
			'first_name' 			=> 'required|min:2|alpha',
			'last_name' 			=> 'required|min:2|alpha',
			'dob' 					=> 'required|before:now',
			'username' 				=> 'required|alpha_num|unique:users',
			//minecraft is a custom rule defined in helpers.php
			'mcname' 				=> 'required|alpha_dash|max:16|unique:users|minecraft',
			'email' 				=> 'required|min:4|max:32|email|unique:users',
			'email_confirmation' 	=> 'required',
			'password' 				=> 'required|min:6|confirmed',
			'password_confirmation' => 'required'
		];
		 $message = [
		 	'minecraft' => 'This minecraft account does not exist or has not been registered with Mojang.'
		 ];

		$v = Validator::make($input, $rules, $message);

		if($v->fails())
		{
			// Validation has failed
			return Redirect::to('users/register')->withErrors($v)->withInput();
		}else{
			try{
				//Attempt to register the user.
				$user = Sentry::register([
					'first_name' 	=> $input['first_name'],
					'last_name' 	=> $input['last_name'],
					'dob' 			=> $input['dob'],
					'username' 		=> $input['username'],
					'mcname' 		=> $input['mcname'],
					'email' 		=> $input['email'],
					'password' 		=> $input['password']
				]);
				//Get the activation code & prep data for email
				//To be done.

				//success!
				Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
				return Redirect::route('home');
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				Session::flash('error', 'Login field required.');
				return Redirect::to('users/register')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
				Session::flash('error', 'User already exists.');
				return Redirect::to('users/register')->withErrors($v)->withInput();
			}
		}
	}

}
