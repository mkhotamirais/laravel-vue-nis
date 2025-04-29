<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'ahmad',
                'email' => 'ahmad@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'admin',
                'remember_token' => null,
            ],
            [
                'name' => 'editorponpes',
                'email' => 'editorponpes@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'editor_ponpes',
                'remember_token' => null,
            ],
            [
                'name' => 'editorra',
                'email' => 'editorra@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'editor_ra',
                'remember_token' => null,
            ],
            [
                'name' => 'editormts',
                'email' => 'editormts@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'editor_mts',
                'remember_token' => null,
            ],
            [
                'name' => 'editorma',
                'email' => 'editorma@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'editor_ma',
                'remember_token' => null,
            ],
            [
                'name' => 'abdul',
                'email' => 'abdul@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'role' => 'user',
                'remember_token' => null,
            ],

        ]);
    }
}
