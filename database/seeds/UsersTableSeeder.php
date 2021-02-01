<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->truncate();
        
        \DB::table('users')->insert([
         
            'name' => 'Filip Djurdjevic',
            'email' => 'f.djurdjevic90fik@gmail.com',		
            'photo' => '',		
            'phone' => '0641234567',		
            'status' => '1',		
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
            
        \DB::table('users')->insert([
         
            'name' => 'Pera Peric',
            'email' => 'pera.peric@cubes.rs',	
             'photo' => '',		
            'phone' => '0641221567',		
            'status' => '1',
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
         
            'name' => 'Marija Markovic',
            'email' => 'mara.markovic@cubes.rs',
             'photo' => '',		
            'phone' => '0641234347',		
            'status' => '1',
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
         
            'name' => 'Marko Markovic',
            'email' => 'mare.markovic@cubes.rs',
             'photo' => '',		
            'phone' => '0641234127',		
            'status' => '1',
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        
        \DB::table('users')->insert([
         
            'name' => 'Ivan Peric',
            'email' => 'ivan.peric@cubes.rs',
             'photo' => '',		
            'phone' => '0641234787',		
            'status' => '1',
            'password' => \Hash::make('cubesphp'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
