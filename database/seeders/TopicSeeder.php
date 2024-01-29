<?php

namespace Database\Seeders;

use App\Models\Meta;
use App\Models\Topic;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Topic::factory()->count(3)->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Topic',
            ]);

            return $page->meta()->create($meta->toArray());
        });

        Topic::factory()->count(5)->inReview()->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Topic',
            ]);

            return $page->meta()->create($meta->toArray());
        });

        Topic::factory()->count(15)->published()->create()->each(function ($page) {
            $meta = Meta::factory()->make([
                'metaable_id' => $page->id,
                'metaable_type' => 'App\Models\Topic',
            ]);

            return $page->meta()->create($meta->toArray());
        });
    }
}
