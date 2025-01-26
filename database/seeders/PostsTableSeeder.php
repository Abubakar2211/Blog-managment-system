<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('posts')->insert([
            [
                'title' => 'First Post by Admin',
                'content' => 'This is the content of the first post by Admin.',
                'user_id' => 1,
                'status' => 'published'
            ],
            [
                'title' => 'Second Post by Admin',
                'content' => 'This is the content of the first post by Admin.',
                'user_id' => 2,
                'status' => 'draft'
            ],
        ]);
    }
}
