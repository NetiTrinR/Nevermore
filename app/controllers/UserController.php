<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Tag;
class UserController extends BaseController
{

	public function __construct()
	{
		//Check CSRF token on POST
		$this->beforeFilter('csrf', array('on' => 'post'));

		//Enable the throttler. [I am not sure about this...]
		// Get the Throttle Provider
		$throttleProvider = Sentry::getThrottleProvider();

		// Enable the Throttling Feature
		$throttleProvider->enable();
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
			'rememberMe'	=> Binput::get('rememberMe'),
		];
		$rules = [
			'email' 	=> 'required|min:4|max:32|email',
			'password' 	=> 'required|min:6',
		];
		$v = Validator::make($input, $rules);

		if($v->fails()){
			return Redirect::to('user/login')->withErrors($v)->withInput();
		}else{
			try
			{
				//Check for suspension or banned status
				$user = Sentry::getUserProvider()->findByLogin($input['email']);
				$throttle = Sentry::getThrottleProvider()->findByUserId($user->id);
				$throttle->check();

				// Set login credentials
				$credentials = [
					'email' => $input['email'],
					'password' => $input['password']
				];

				// Try to authenticate the user
				$user = Sentry::authenticate($credentials, $input['rememberMe']);

			}
			catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
			{
				// Sometimes a user is found, however hashed credentials do
				// not match. Therefore a user technically doesn't exist
				// by those credentials. Check the error message returned
				// for more information.
				Session::flash('error', 'Invalid username or password.' );
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
			{
				Session::flash('error', 'You have not yet activated this account.');
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
			// The following is only required if throttle is enabled
			catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
			{
				$time = $throttle->getSuspensionTime();
				Session::flash('error', "Your account has been suspended for $time minutes.");
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
			{
				Session::flash('error', 'You have been banned.');
				return Redirect::to('user/login')->withErrors($v)->withInput();
			}
			//Login was succesful.
			return Redirect::route('home');
		}
	}

	public function getLogout(){
		Sentry::logout();
		return Redirect::to('/');
	}

	public function getRegister(){
		return View::make('user.register')
			->with('title', 'Registration');
	}

	public function postRegister(){
		Validator::extend('minecraft', function($attribute, $value, $parameters){
			$check_mcUser = file_get_contents('http://www.minecraft.net/haspaid.jsp?user='.$value.'');
			if ($check_mcUser == 'true')
				return true;
			return false;
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
			return Redirect::to('user/register')->withErrors($v)->withInput();
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
				$data['activationCode'] = $user->GetActivationCode();
				$data['email'] = $input['email'];
				$data['userId'] = $user->getId();

				//send email with link to activate.
				Mail::send('emails.auth.welcome', $data, function($m) use($data)
				{
				    $m->from('nevermore.server@gmail.com')->to($data['email'])->subject('Welcome to Nevermore');
				});

				//success!
				Session::flash('success', 'Your account has been created. Check your email for the confirmation link.');
				return Redirect::route('home');
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				Session::flash('error', 'Login field required.');
				return Redirect::to('user/register')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
				Session::flash('error', 'User already exists.');
				return Redirect::to('user/register')->withErrors($v)->withInput();
			}
		}
	}

	public function getActivate($userId = null, $activationCode = null) {
		try 
		{
		    // Find the user
		    $user = Sentry::getUserProvider()->findById($userId);

		    // Attempt user activation
		    if ($user->attemptActivation($activationCode))
		    {
		        // User activation passed
		        
		        //Create Microblog
		        $micro = new Thread;
		        $micro->name = User::find($userId)->username;
		        $micro->cat_id = 3;
		        $micro->save();

		    	//Add this person to the user group. 
		    	$userGroup = Sentry::getGroupProvider()->findById(1);
		    	$user->addGroup($userGroup);

		        Session::flash('success', 'Your account has been activated. <a href="'.URL::to('/user/login').'">Click here</a> to log in.');
				return Redirect::to('/');
		    }
		    else
		    {
		        // User activation failed
		        Session::flash('error', 'There was a problem activating this account. Please contact Rails.');
				return Redirect::to('/');
		    }
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    Session::flash('error', 'User does not exist.');
			return Redirect::to('/');
		}
		catch (Cartalyst\Sentry\Users\UserAlreadyActivatedException $e)
		{
		    Session::flash('error', 'You have already activated this account.');
			return Redirect::to('/');
		}
	}

	public function getProfile($user)
	{
		try{
			$user = User::where('username','=', $user)->firstOrFail();
			$threadData = Thread::where('cat_id', '=', 3)->where('name', '=', $user->username)->firstOrFail();
			$tags = Tag::where('created_by', '=', $user->id)->get();
			$replyData = Reply::where('thread_id', '=', $threadData->id)->join('users', 'replies.created_by', '=', 'users.id')->orderBy('replies.created_at', 'DESC')->select('replies.*', 'users.username', 'users.email')->get();
			return View::make('user.profile')
				->with('replyData', $replyData)
				->with('userData', $user)
				->with('userOption', (object) ['email' => false, 'age' => false, 'twit' => false,])
				->with('tags', $tags)
			 	->with('title', $user->username." - Profile");
		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return App::abort(404);
		}
	}
	
	public function postProfile($user)
	{
		if( ! Sentry::check())
			return Redirect::route('login');
		try{
			$user = User::where('username','=', $user)->firstOrFail();
			
			$input = [
				'created_by' => Sentry::getUser()-> id,
				'body' => Binput::get('body')
			];
			$rules = [
				'body' => 'required|min:10|max:150'
			];
			$v = Validator::make($input, $rules);
			if($v->fails()){
				return Redirect::to("user/$user->username/profile")->withErrors($v)->withInput();
			}else{
				$post = new Reply;
				$post->thread_id = Thread::where('name', '=', $user->username)->where('cat_id', '=', 3)->firstOrFail()->id;
				$post->body = $input['body'];
				$post->created_by = $input['created_by'];
				$post->save();
				Session::flash('success', "You have successfully posted to $user->username's profile page.");
				return Redirect::to("user/$user->username/profile");
			}
		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return App::abort(404);
		}
	}

	public function getEdit($user)
	{
		try{
			$user = User::where('username', '=', $user)->firstOrFail();
			return View::make('user.edit')
				->with('userData', $user)
				->with('title', $user->username." - Edit");
		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return App::abort(404);
		}
	}
}