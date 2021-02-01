<?php

use Illuminate\Database\Seeder;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        \DB::table('blogs')->truncate();
        
      
        
        $blogCategoryIds = \DB::table('blog_categories')->get()->pluck('id');
        $usersIds = \DB::table('users')->get()->pluck('id');
        
        $faker = \Faker\Factory::create();
        
        for ($i = 1; $i <= 125; $i ++) {
            
            \DB::table('blogs')->insert([
                'name' => $faker->catchPhrase ,
                'blog_text' => $faker->realText(255),
                'photo' => '',
                'blog_category_id' => $blogCategoryIds->random(),
                'priority' => $i,
                'number_of_views' =>rand(1, 100),
                'number_of_comments' => rand(1, 100),
                'user_id' => $usersIds->random(),
                'index_page' => rand(100, 999) % 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
