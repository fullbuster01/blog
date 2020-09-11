<?php

use App\Tag;
use Illuminate\Support\Str;
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
        $tags = collect(['Laravel', 'Vue', 'Codeigniter', 'React']);
        $tags->each(function ($t) {
            Tag::create([
                'name' => $t,
                'slug' => Str::slug($t)
            ]);
        });
    }
}
