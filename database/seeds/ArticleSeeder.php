<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Article;
use Faker\Generator as Faker;  
use App\User;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i <10; $i++) { 
            
            $user = User::inRandomOrder()->first();

            $newArticle = new Article;
            $newArticle->user_id = $user->id;
            $newArticle->title = $faker->sentence(6, true);
            $newArticle->slug = str::of($newArticle->title)->slug('-');
            $newArticle->content = $faker->sentence(20);

            $newArticle ->save();
        }
    }
}
