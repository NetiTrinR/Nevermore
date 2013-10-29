<?php
 
use App\Models\User;
 
class SentrySeeder extends Seeder {
 
    public function run()
    {
        DB::table('users')->delete();
        DB::table('groups')->delete();
        DB::table('users_groups')->delete();
 
        Sentry::getUserProvider()->create(array(
            'email'       => 'netitrinr@gmail.com',
            'password'    => "123456",
            'username'    => 'Rails',
            'first_name'  => 'Michael',
            'last_name'   => 'Manning',
            'activated'   => 1,
        ));
        Sentry::getUserProvider()->create(array(
            'email'       => 'another@email.com',
            'password'    => "123456",
            'username'    => 'Another user',
            'first_name'  => 'rawren',
            'last_name'   => 'derpderp',
            'activated'   => 1,
        ));
        Sentry::getUserProvider()->create(array(
            'email'       => 'oncemore@gmail.com',
            'password'    => "123456",
            'username'    => 'LaFleur',
            'first_name'  => 'Hannah',
            'last_name'   => 'leriver',
            'activated'   => 1,
        ));
        Sentry::getGroupProvider()->create(array(
            'name'        => 'Admin',
            'permissions' => array('admin' => 1),
        ));
 
        // Assign user permissions
        $adminUser  = Sentry::getUserProvider()->findByLogin('netitrinr@gmail.com');
        $adminGroup = Sentry::getGroupProvider()->findByName('Admin');
        $adminUser->addGroup($adminGroup);
    }
 
}