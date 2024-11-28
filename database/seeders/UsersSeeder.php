<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(

            [
                'name' => 'Diaz Luthfi',
                'email' => 'diaz@gmail.com',
                'position' => 'Website Developer',
                'image' => 'users/diaz.jpg',
                'password' => Hash::make('123'),

            ]
        );

        DB::table('users')->insert(
            [
                'name' => 'Kristanto Wibowo',
                'email' => 'kristanto@gmail.com',
                'position' => 'Website Programmer',
                'image' => 'users/Frame98700.png',
                'password' => Hash::make('123'),

            ]
        );
    }
}
