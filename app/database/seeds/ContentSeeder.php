<?php
 
use App\Models\Thread;
use App\Models\Reply;
 
class ContentSeeder extends Seeder {
 
    public function run()
    {
        Eloquent::unguard();
        DB::table('threads')->delete();
        DB::table('replies')->delete();
 
        Thread::create(array(
            'thr_name'   => 'First post',
            'thr_subject'    => 'first-post',
            'thr_body'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'thr_by' => 1,
            'thr_cat' => 1,
        ));
 
        Reply::create(array(
            'rply_thread'   => 1,
            'rply_body'    => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            'rply_by' => 1,
        ));
    }
 
}