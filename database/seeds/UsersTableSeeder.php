<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'New Admin',
            'username' => 'admin2',
            'email' => 'admin2@blog.com',
            'password' => bcrypt('rootadmin')
        ]);

        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'New Author',
            'username' => 'author2',
            'email' => 'author2@blog.com',
            'password' => bcrypt('rootauthor')
        ]);
    }
}
