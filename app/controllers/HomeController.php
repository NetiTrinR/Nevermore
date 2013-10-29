<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Tag;
class HomeController extends BaseController {

	public $restful = true;

	public function getIndex()
	{
		return View::make('hello')
			->with('title', 'Welcome to Nevermore');
	}
	public function getHome()
	{
		$monthago = Carbon::now()->subMonth();
		$newusers = DB::table('users')->where('created_at', '>', "$monthago")->orderBy('created_at', 'ASC')->take(3)->select('username')->get();
		$shames = DB::table('shame')->where('shame.created_at', '>', "$monthago")->join('users', 'shame.user_id','=', 'users.id')->orderBy('shame.created_at', 'ASC')->take(3)->get();
		$recent = Thread::where('cat_id','=',1)->orderBy('created_at','desc')->take(3)->get();
		$bumped = Thread::where('cat_id','=',1)->orderBy('updated_at','asc')->take(3)->get();
		$trend = $recent;
		$announcement = Tag::find(2)->threads->take(5)->sortBy(function($sorter){return $sorter->updated_at;})->reverse();
		return View::make('home')
			->with('announcement', $announcement)
			->with('recent', $recent)
			->with('bumped', $bumped)
			->with('trend', $trend)
			->with('title', 'Home')
			->with('jumbo', true)
			->with('header', ['Homepage', 'Welcome home.'])
			->with('shames', $shames)
			->with('newusers', $newusers);

	}
	public function getServerstatus(){
		if(Request::ajax())
			return Response::json(Helper::queryMinecraft('172.245.213.216'));
		return App::abort(404);
	}
	public function getAbout()
	{
		return View::make('about')
			->with('title', 'About us')
			->with('jumbo', true);
	}
	public function getPrivacy()
	{
		return View::make('privacy')
			->with('title', 'Privacy Policy');
	}
	public function getTerms()
	{
		return View::make('terms')
			->with('title', 'Terms & Conditions');
	}
	public function getRules()
	{
		return View::make('rules')
			->with('title', 'Rules')
			->with('jumbo', true);
	}
	public function getFaq(){
		return View::make('faq')
			->with('title', 'Facts & Questions')
			->with('jumbo', true);
	}
	public function getBug(){
		return Redirect::Route('home');
	}
}