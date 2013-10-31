<?php
use App\Models\User;
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Tag;
use dflydev\markdown\MarkdownExtraParser;
class ForumController extends BaseController {
	
	public function __construct(){
	}
	public function getIndex($page = 1){
		$recent = Thread::where('cat_id','=',1)->orderBy('created_at','desc')->skip(($page-1)*30)->take(30)->get();
		$bumped = Thread::where('cat_id','=',1)->orderBy('updated_at','asc')->skip(($page-1)*30)->take(30)->get();
		$trend = $recent;
		//Ew I don't like this... I need to readjust the query
		foreach ($recent as $thread) {
			$thread{'count'} = Reply::where('thread_id','=',$thread->id)->count();
			$thread{'first'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','asc')->first();
			$thread{'last'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','desc')->first();
		}
		foreach($bumped as $thread){
			$thread{'count'} = Reply::where('thread_id','=',$thread->id)->count();
			$thread{'first'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','asc')->first();
			$thread{'last'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','desc')->first();
		}
		foreach($trend as $thread){
			$thread{'count'} = Reply::where('thread_id','=',$thread->id)->count();
			$thread{'first'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','asc')->first();
			$thread{'last'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','desc')->first();
		}
		return View::make('forum.index')
			->with('recent', $recent)
			->with('trend', $trend)
			->with('bumped', $bumped)
			->with('title', 'Forum homepage')
			->with('header', ['Nevermore Forums', 'Talk about stuff']);
	}
	public function getThread($id, $page = 1){
		try{
			$thread = Thread::where('id','=', $id)->where('cat_id', '<=', 2)->firstOrFail();
			//Admin forum filter
			if($thread->cat_id == 2&&Sentry::getUser()->hasAnyAccess(['admin']) != true){
				return App::abort(404);
			}
			$tags = DB::table('tags')->join('tag_thread','tag_thread.tag_id','=','tags.id')->where('tag_thread.thread_id','=',$id)->get();
			$replies = Reply::where('thread_id', '=', $id)->skip(($page-1)*30)->take(30)->get();
			return View::make('forum.thread')
				->with('markdown', new MarkdownExtraParser())
				->with('tags', $tags)
				->with('threadData', $thread)
				->with('replyData', $replies)
			 	->with('title', $thread->name)
			 	->with('header', [$thread->name, $thread->subject]);
		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return App::abort(404);
		}
	}
	public function getTag($id, $page = 1){
		try
		{
			$tag = Tag::where('id', $id)->firstOrFail();
			$threads = $tag->threads()->skip(($page-1)*30)->take(30)->get();
			foreach ($threads as $thread) {
				$thread{'count'} = Reply::where('thread_id','=',$thread->id)->count();
				$thread{'first'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','asc')->first();
				$thread{'last'} = Reply::select('replies.id','replies.created_at','users.username','users.email')->where('thread_id','=',$thread->id)->join('users','replies.created_by','=','users.id')->orderBy('replies.created_at','desc')->first();
			}
			return '<pre>'.var_dump($threads).'</pre>';

		}
		catch(Illuminate\Database\Eloquent\ModelNotFoundException $e)
		{
			return App::abort(404);
		}
	}
	public function postReply(){
		$input =[
			'body' => Binput::get('body'),
			'thread_id' => Binput::get('thread_id'),
			'user_id' => Binput::get('user_id')
		];
		$rules = [
			'body' => 'required|min:10',
			'thread_id' => 'exists:threads,id',
		];
		$v = Validator::make($input, $rules);
		if($v->fails()){
			return Redirect::to('forum/'.$input['thread_id'])->withErrors($v)->withInput();
		}else{
			$newReply = new Reply;
			$newReply->thread_id = $input['thread_id'];
			$newReply->body = $input['body'];
			$newReply->created_by = Sentry::getUser()->id;
			$newReply->save();
			Session::flash('success','You have successfully posted a reply.');
			return Redirect::to('forum/'.$newReply->thread_id);
		}
	}
	public function getCreate(){
		return View::make('forum.create')
			->with('title', 'Create Thread');
	}
	public function postCreate(){
		$input = [
			'title' => Binput::get('title'),
			'subject' => Binput::get('subject'),
			'tags' 	=> Input::get('tags'),
			'body'	=> Binput::get('body')
		];
		$rules = [
			'title'	=> 'required|between:4,255|unique:threads,name,NULL,id,cat_id,1',
			'subject' => 'between:4,255',
			'body'	=> 'required|min:50'
		];
		$v = Validator::make($input, $rules);
		if ($v->fails()) {
			return Redirect::to('forum/create')->withErrors($v)->withInput();
		}else{
			//Thread
			$newThread = new Thread;
			$newThread->name = $input['title'];
			$newThread->subject = $input['subject'];
			$newThread->cat_id = 1;
			$newThread->save();
			//Reply
			$firstReply = new Reply;
			$firstReply->thread_id = $newThread->id;
			$firstReply->body = $input['body'];
			$firstReply->created_by = Sentry::getUser()->id;
			$firstReply->save();
			//Tags
			if($input['tags']!=null){
				$newTags = array();
				foreach ($input['tags'] as $tag) {
					array_push($newTags, ['thread_id'=>$newThread->id,'tag_id'=>$tag]);
				}
				DB::table('tag_thread')->insert($newTags);
			}
			//Redirect
			Session::flash('success', 'You have successfully created a thread.');
			return Redirect::to('forum/'.$newThread->id);
		}
	}
	public function getDelete($type = null, $id = null){
		if($type!=null||$id!=null){
			try{
				switch($type){
					case 'thread':
						$delete = Thread::find($id);
						$first = Reply::where('thread_id','=', $delete->id)->orderBy('created_at', 'asc')->firstOrFail();
						$created_by = $first->created_by;
					break;
					case'reply':
						$delete = Reply::find($id);
						$created_by = $delete->created_by;
					break;
				}
				if(Sentry::getUser()->hasAnyAccess(['admin'])||$delete->created_by == Sentry::getUser()->id){
					$delete->delete();
					Session::flash('success', 'Your '.$type.' has successfully been deleted.');
					return Redirect::route('forum');
				}
			}catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
				return App::abort(404);
			}
		}
		return App::abort(404);
	}
	public function postCreateTag(){
		$input = [
			'tags' => Binput::get('tags')
		];
		$rules = [
			'tags' => ['required','regex:/^([a-zA-Z0-9_-]+( |))*$/']
		];
		$v = Validator::make($input, $rules);
		if($v->fails()){
			return $v->messages();
			return Response::json(['outcome' => 2,'msg' => 'Your input doesn\'t match the correct format. You are only allowed to use alpha-numeric characters and dashs in the tag name.']);
		}else{
			$errorTags = array();
		    $tags = explode(' ', $input['tags']);
		    foreach($tags as $tag){
		    	$db = App\Models\Tag::where('name', $tag)->get();
		    	if(($db->count())>0){
		    		if($db[0]->type == 2&&!Sentry::getUser()->hasAnyAccess(['admin']))
		    			$errorTags["$tag"] = 2;//Admin reserved
		    		elseif($db[0]->type == 3)
		    			$errorTags["$tag"] = 3;//Blacklisted
		    		else
		    			$errorTags["$tag"] = 1;//Already exists
		    	}else{
		    		$newTag = new App\Models\Tag;
		    		$newTag->name = $tag;
		    		$newTag->type = 1;
		    		$newTag->created_by = Sentry::getUser()->id;
		    		$newTag->created_at = Carbon::parse('now');
		    		$newTag->updated_at = Carbon::parse('now');
		    		$newTag->save();
		    	}
		    }
		    if(!empty($errorTags)){
			    $msg = '<ul>';
			    foreach ($errorTags as $tag => $error) {
			    	$msg.= "<li>$tag - ";
			    	if($error == 2)
			    		$msg.= 'This tag is reserved.</li>';
			    	elseif($error == 3)
			    		$msg.= 'This tag is unavailable.</li>';
			    	else
			    		$msg.= 'This tag already exists, feel free to use it.</li>';
			    }
			    $msg.='</ul>';
			    return Response::json(['outcome'=>3,'msg'=>"The tags listed below have some problems.  The rest have been added. Correct the issues below and remove the successful tags from your next submit.<br />$msg"]);
		    }
		    return Response::json(['outcome'=>1,'msg'=>'Tags created Successfully!']);//No errors
		}
	}
	public function postFlag(){
		if(!Request::ajax())
			return App::abort(404);

		$input = [
			'flag' => Binput::get('flag'),
			'type' => Binput::get('type')
		];
		$rules = [
			'flag' => 'numeric',
			'type' => 'numeric'
		];
		$v = Validator::make($input, $rules);
		if($v->fails()){
			$output = [2,'The flag was in incorrect format. If error persists contact Railalis.'];
		}else{
			try{
				if($input['type']==1)
					$data = Reply::find($input['flag']);
				elseif($input['type']==2)
					$data = Tag::find($input['flag']);
				if(!DB::table('flags')->where('id','=', $data->id)->where('type', '=', $input['type'])->where('created_by','=',Sentry::getUser()->id)->count()>0)
					DB::table('flags')->insert(['id'=>$data->id, 'type'=>$input['type'],'created_by'=>Sentry::getUser()->id, 'created_at'=>Carbon::now(), 'updated_at'=>Carbon::now()]);
				$output = [1,'The reply has been flagged for review. Thank you.'];
			}catch(Illuminate\Database\Eloquent\ModelNotFoundException $e){
				$output = [2,'The reply could not be found. Reply has not been flagged. If error persists contact Railalis.'];
			}
		}
		return Response::json($output);
	}
	public function getChosenTags(){
		if(!Request::ajax())
			return App::abort(404);
		$options = '';
		if(Sentry::getUser()->hasAnyAccess(['admin']))
			$tags = Tag::where('type', 1)->orwhere('type', 2)->get();
		else
			$tags = Tag::where('type', 1)->get();
		foreach($tags as $tag){
    		$options.= '<option value="'.$tag->id.'">'.str_replace('_', ' ', $tag->name).'</option>';
    	}
    	return $options;
	}
}