<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        DB::table('users')->insert([

            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>Hash::make('111'),
            'phone'=>'05000000001',
            'username'=>'admin',
            'role'=>'admin'

        ]);
        //instructor

        DB::table('users')->insert([

            'name'=>'instructor',
            'email'=>'instructor@gmail.com',
            'password'=>Hash::make('111'),
            'phone'=>'05000000002',
            'username'=>'instructor',
            'role'=>'instructor'

        ]);

        //user
        DB::table('users')->insert([

            'name'=>'user',
            'email'=>'user@gmail.com',
            'password'=>Hash::make('111'),
            'phone'=>'05000000003',
            'username'=>'user',
            'role'=>'user'

        ]);
    }
}
