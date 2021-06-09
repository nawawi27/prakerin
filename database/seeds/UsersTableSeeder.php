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
            'nama_lengkap' => 'Jquin Nekosuki',
            'username' => 'developer',
            'password' => bcrypt('rahasia'),
            'role' => 'Admin',
            'path' => 'default.png'
        ]);
    }
}
