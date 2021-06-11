<?php

use Illuminate\Database\Seeder;
use App\Post;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        	$faker = Faker\Factory::create();

    	foreach (range(1,20) as $index) {
			$post = $faker->unique()->sentence;
    		 Post::create([
		     'user_id' => rand(1,20),
		     'category_id' => rand(1,5),
		     'title' => $post,
		     'slug' => slugify($post),
		     'content' => $faker->paragraph,
		     'image' => $faker->imageUrl,
		     'status' => rand(0,1),
    ]);
    	}
    }
}
