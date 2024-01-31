<?php

namespace Database\Seeders;

use App\Models\Faq;
use App\Models\Meta;
use Spatie\Tags\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::factory()
            ->count(3)
            ->create();

        Faq::factory()
            ->count(5)
            ->inReview()
            ->create();

        Faq::factory()
            ->count(15)
            ->published()
            ->create();
    }
}
