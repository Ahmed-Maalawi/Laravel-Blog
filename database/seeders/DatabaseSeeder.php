<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        User::truncate();
//        Category::truncate();
//        Post::truncate();


        $user = User::factory()->create([
            'name' => 'Ahmed'
        ]);

        User::factory(5)->create();

        $categories = [
          [
              'name' => 'MY Work',
              'slug' => 'my-work'
          ],[
              'name' => 'Personal',
              'slug' => 'personal'
          ],[
              'name' => 'Home',
              'slug' => 'home'
          ]
        ];

        foreach ($categories as $category)
        {
            Category::factory()->create([
                'name' => $category['name'],
                'slug' => $category['slug']
            ])->each(function ($category) {
                Post::factory(5)->create([
                    'user_id' => rand(1,6),
                    'category_id' => $category->id
                ])->each(function ($post) {
                    Comment::factory(rand(1, 10))->create([
                        'post_id' => $post['id'],
                    ]);
                });
            });
        }

//        $categories->each(function ($category) {
//           Post::factory()->create([
//               'user_id' => rand(1,6),
//               'category_id' => $category['id']
//           ]);
//        });

//        Post::factory(9)->create();
    }
}
