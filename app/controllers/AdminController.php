<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
class AdminController extends BaseController {
	
	public $restful = true;

	public function __construct(){
        $this->beforeFilter('admin_auth');
    }

	public function getIndex(){
		return View::make('admin.index')
			->with('title', 'Admin Dashboard')
			->with('header', ['Admin Dashboard', 'Tool Navigation']);
	}
	public function getUsers(){
		$users = User::all();
		$trash = User::onlyTrashed()->get();
		return View::make('admin.users')
			->with('title', 'Admin Users')
			->with('header', ['Admin Dashboard', 'User Panel'])
			->with('users', $users)
			->with('trash', $trash);
	}
	public function getThreads(){
		$threads = Thread::withTrashed()->join('cats','threads.cat_id', '=', 'cats.id')->select('threads.*', 'cats.name as cat_name')->get();
		foreach($threads as $thread){
			$first = Reply::select('replies.created_by','users.username')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','asc')->first();
			$thread->created_by = $first['created_by'];
			$thread->username = $first['username'];
			$thread->replies = Reply::where('thread_id','=',$thread->id)->count();	
		}
		return View::make('admin.threads')
			->with('title', 'Admin Threads')
			->with('header', ['Admin Dashboard', 'Thread Panel'])
			->with('threads', $threads);
	}
}
