<?php

namespace Database\Seeders;

use App\Models\Meta;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Article::factory()->count(3)->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Article',
            ]);

            return $page->meta()->create($meta->toArray());
        });

        Article::factory()->count(5)->inReview()->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Article',
            ]);

            return $page->meta()->create($meta->toArray());
        });

        Article::factory()->count(15)->published()->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Article',
            ]);

            return $page->meta()->create($meta->toArray());
        });
    }
}
