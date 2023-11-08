<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Post::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        for ($i=0; $i < 30; $i++) { 
            $c = Category::inRandomOrder()->first();
            $title = Str::random(20);

            Post::create([
                'title'=> $title,
                'slug'=> Str::slug($title),
                'content' => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis dolor quod minus esse minima suscipit omnis, neque ipsa nemo. Consectetur, aliquid? Asperiores optio quia est dicta distinctio, cum doloremque quo.",
                'category_id' => $c->id,
                'description'=> "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
                'posted'=>"yes"
            ]);
        }
    }
}
