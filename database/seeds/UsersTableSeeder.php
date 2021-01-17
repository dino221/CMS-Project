<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $adminRole = Role::where('name', 'admin')->first();
        $editorRole = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'phone' => '091556665',
            'avatar' => 'defaultAvatar.jpg',
            'email' => 'admin@seminar.com',
            'password' => bcrypt('admin')
            ]);

        $editor = User::create([
            'name' => 'Author',
            'phone' => '091556665',
            'avatar' => 'defaultAvatar.jpg',
            'email' => 'editor@seminar.com',
            'password' => bcrypt('editor')
        ]);

        $user = User::create([
            'name' => 'User',
            'phone' => '091556665',
            'avatar' => 'defaultAvatar.jpg',
            'email' => 'user@seminar.com',
            'password' => bcrypt('user')
        ]);

        $admin->roles()->attach($adminRole);
        $editor->roles()->attach($editorRole);
        $user->roles()->attach($userRole);

    }
}
