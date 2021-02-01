<?php

use Illuminate\Database\Seeder;
use App\Models\IndexSlider;
class IndexSlidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         \DB::table('index_sliders')->truncate();
        
        
        $faker = \Faker\Factory::create();
        
       $links=['https://www.facebook.com/','https://www.instagram.com/','https://cubes.edu.rs/','https://www.amazon.com/','https://www.google.com/','https://twitter.com/','https://www.alibabagroup.com/en/global/home', 'https://www.spotify.com', 'https://www.netflix.com','https://www.ebay.com/'];
               
       
            foreach ($links as $key => $link){
            \DB::table('index_sliders')->insert([
                'name' => $faker->company ,
                'headline' => $faker->catchPhrase ,
                'link' => $link ,
                'photo' => '',
                'priority' =>$key ,
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
            }
    }
}
