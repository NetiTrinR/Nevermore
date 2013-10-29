<?php
 
use App\Models\Thread;
use App\Models\Reply;
use App\Models\Tag;
use App\Models\Cat;

class ContentSeeder extends Seeder {
 
    public function run()
    {
        Eloquent::unguard();
        DB::table('cats')->delete();
        DB::table('threads')->delete();
        DB::table('replies')->delete();
        DB::table('tags')->delete();
        DB::table('tag_thread')->delete();
        // DB::table('flags')->delete();
        //Make cat
        Cat::create([
            'name' => 'Threads'//1
        ]);
        Cat::create([
            'name' => 'Admin Threads'//2
        ]);
        Cat::create([
            'name' => 'Microblogs'//3
        ]);
        Cat::create([
            'name' => 'Events'//4
        ]);
        Cat::create([
            'name' => 'Gallery'//5
        ]);
        //Make thread
        Thread::create([
            'name'   => 'First post',
            'cat_id' => 1,
            'subject' => 'First post was seeded.',
        ]);
        //Admin thread
        Thread::create([
            'name' => 'Read me',
            'cat_id' => 2,
            'subject' => 'Breif Explination of Forums',
        ]);
        //Micro Blogs
        Thread::create([
            'name' => 'Rails',
            'cat_id' => 3,
        ]);
        Thread::create([
            'name' => 'Another user',
            'cat_id' => 3,
        ]);
        Thread::create([
            'name' => 'LaFleur',
            'cat_id' => 3,
        ]);
        //Make thread body
        Reply::create([
            'body'    => 'Body of the first thread!',
            'thread_id' => 1,
            'created_by' => 1,
        ]);
        Reply::create([
            'body'    => 'Second post',
            'thread_id' => 1,
            'created_by' => 1,
        ]);
        Reply::create([
            'body'    => 'Third',
            'thread_id' => 1,
            'created_by' => 1,
        ]);
        Reply::create([
            'body'    => 'Forth',
            'thread_id' => 1,
            'created_by' => 1,
        ]);
        Reply::create([
            'body' => 'First micro blog post',
            'thread_id' => 3,
            'created_by' => 1,
        ]);
        //Make tag
        Tag::create([
            'name' => 'Admin',
            'created_by' => 1,
            'created_at' => Carbon::parse('now'),
            'updated_at' => Carbon::parse('now'),
            'type' => 2,
        ]);
        Tag::create([
            'name' => 'Announcement',
            'created_by' => 1,
            'created_at' => Carbon::parse('now'),
            'updated_at' => Carbon::parse('now'),
            'type' => 2,
        ]);
        Tag::create([
            'name' => 'NSFW',
            'created_by' => 1,
            'created_at' => Carbon::parse('now'),
            'updated_at' => Carbon::parse('now'),
            'type' => 3,
        ]);

        //Add to tag pivot table
        DB::table('tag_thread')->insert([
            'tag_id'=>1,
            'thread_id'=>1
        ]);
        DB::table('tag_type')->insert(array(
            ['name'=>'User made'],
            ['name'=>'Admin Access'],
            ['name'=>'Blacklisted']
        ));
        DB::table('flag_type')->insert(array(
            ['name'=>'Reply'],
            ['name'=>'Tag'],
            ['name'=>'Event']
        ));
        //Make reply
        Reply::create([
            'body' => 'First Reply to thread 1',
            'thread_id'  => 1,
            'created_by' => 1,
        ]);
    }
 
}