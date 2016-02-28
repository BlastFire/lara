<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        //$this->call(UserTableSeeder::class);
        //factory(App\User::class, 4)->create();
        //creates 10 test posts
        factory(App\Post::class, 10)->create();
        //creates 6 comments
        //factory(App\Comment::class, 6)->create();

        Model::reguard();
    }
}
