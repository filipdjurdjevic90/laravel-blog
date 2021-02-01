<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          \DB::table('tags')->truncate();
        
        $tags = ['Advertising','Advice','Android','Anime','Apple','Architecture','Art','Baking','Books','Beauty',' Bible ',
            'Blog','Blogging','Book Reviews','Books','Business','Cars','Cartoons','Celebrities','Celebrity',
            'Children','Christian','Food','Comedy','Comics','Cooking','Cosmetics','Crafts','Cuisine','Culinary','Culture',
            'Dating','Design','Diy','Dogs','Drawing','Education','Entertainment','Environment','Events',
            'Faith','Family','Fantasy','Fashion','Fiction','Film','Fitness','Folk','Food','Football','France',
            'Fun','Funny','Gadgets','Games','Gaming','Geek','Google','Gossip','Graphic Design',
            'Health','Hip Hop','History','Home','Home Improvement','Homes','Humor','Hunting','Illustration','Inspiration','Interior Design',
            'Internet','Internet Marketing','Iphone','Fashion','Kids','DIY','Landscape','Law','Leadership',
            'Life','Lifestyle','Literature','Love','Cars','Music','Management','Marketing','Media','Men','Mobile',
            'Money','Nature','News','Fashion','Nutrition','Painting','Parenting','Personal','Personal Development',
            'Pets','Philosophy','Photo','Photography','Photos','Music','Games','Movies','Books','Fitness','Mom',
            'Pictures','Poetry','Politics','Real Estate','Recipes','Relationships','Religion','Retirement','Reviews',
            'Science','Seo','Sex','Shopping','Soccer','Social Media','Software','Sports','Technology','Television','Tips',
            'Travel','Tutorials','Tv','Vacation','Videos','Web','Web Design','Weight Loss','Wellness',
            'Wine','Women','Wildlife','Writing'];
     
        
        foreach ($tags as $tag){
            
         \DB::table('tags')->insert([
            'name'=>$tag,
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);   
        }
    }
}
