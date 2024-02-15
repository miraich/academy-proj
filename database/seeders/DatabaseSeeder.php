<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//        DB::table('categories')->insert([
//            ''
//        ]);

//        $post = Post::factory(15)
//            ->has(Tag::factory()->count(5))
//            ->create();
        DB::table('categories')->insert([
            ['name' => 'photo', 'icon' => 'photo'],
            ['name' => 'video', 'icon' => 'video'],
            ['name' => 'text', 'icon' => 'text'],
            ['name' => 'quote', 'icon' => 'quote'],
            ['name' => 'link', 'icon' => 'link'],
        ]);
    }
}
