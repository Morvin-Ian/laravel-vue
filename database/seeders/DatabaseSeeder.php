<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(10)->create();

        $categories = \App\Models\Category::factory(10)->create();

        foreach($users as $user){
            

            foreach ($categories as $category){

                \App\Models\Post::create([
                    'author'=> $user->id,
                    'category'=> $category->id,
                    'slug' => Str::slug(fake()->unique()->sentence),
                    'title' => fake()->words(3),
                    'body' => fake()->paragraphs(3, true)
                ]);

            }

        }

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
