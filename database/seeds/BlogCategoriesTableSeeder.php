<?php

use Illuminate\Database\Seeder;

class BlogCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('blog_categories')->truncate();
        
        $blog_categories = ['Finance','Sports','Food','Writing','Cars','Music','Games','Movies','Books','Fitness','Mom',
            'Travel','Current Events','Entertainment','Fashion','Lifestyle','DIY','Politics','Parenting','Pets'];
     
        $faker = \Faker\Factory::create();
        foreach ($blog_categories as $key => $blog_category){
            
         \DB::table('blog_categories')->insert([
            'name'=>$blog_category,
            'priority'=>$key+1,
            'description'=>$faker->realText(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);   
        }
           
        
    }
}

    
    
    
    
    
  