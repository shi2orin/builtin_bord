<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'ad',
            'email' => '123@a',
            'password' => bcrypt('password1'),
            'admin_role' => 1,
        ]);
    }
}
