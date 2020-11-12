<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            "natura",
            "tecnologia",
            "animali",
            "viaggi",
            "videogames",
            "filosofia",
            "intrattenimento",
            "cucina"
        ];

        foreach ($tags as $tag) {
            $newTag = new Tag;
            $newTag->name = $tag;
            
            $newTag->save();
        }
    }
}
