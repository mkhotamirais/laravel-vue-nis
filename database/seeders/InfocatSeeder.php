<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InfocatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('infocats')->insert([
            // Admin (user_id = 1)
            [
                'name' => 'cat 1 admin',
                'slug' => Str::slug('cat 1 admin'),
                'user_id' => 1,
            ],
            [
                'name' => 'cat 2 admin',
                'slug' => Str::slug('cat 2 admin'),
                'user_id' => 1,
            ],

            // Editor Ponpes (user_id = 2)
            [
                'name' => 'cat 1 editor ponpes',
                'slug' => Str::slug('cat 1 editor ponpes'),
                'user_id' => 2,
            ],
            [
                'name' => 'cat 2 editor ponpes',
                'slug' => Str::slug('cat 2 editor ponpes'),
                'user_id' => 2,
            ],

            // Editor RA (user_id = 3)
            [
                'name' => 'cat 1 editor ra',
                'slug' => Str::slug('cat 1 editor ra'),
                'user_id' => 3,
            ],
            [
                'name' => 'cat 2 editor ra',
                'slug' => Str::slug('cat 2 editor ra'),
                'user_id' => 3,
            ],

            // Editor MTS (user_id = 4)
            [
                'name' => 'cat 1 editor mts',
                'slug' => Str::slug('cat 1 editor mts'),
                'user_id' => 4,
            ],
            [
                'name' => 'cat 2 editor mts',
                'slug' => Str::slug('cat 2 editor mts'),
                'user_id' => 4,
            ],

            // Editor MA (user_id = 5)
            [
                'name' => 'cat 1 editor ma',
                'slug' => Str::slug('cat 1 editor ma'),
                'user_id' => 5,
            ],
            [
                'name' => 'cat 2 editor ma',
                'slug' => Str::slug('cat 2 editor ma'),
                'user_id' => 5,
            ],
        ]);
    }
}
