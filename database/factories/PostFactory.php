<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Indicate that the page is in review status.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function inReview()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'Review',
            ];
        });
    }

    /**
     * Indicate that the page is in published status.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'Published',
                'published_at' => now()->subDays(rand(0, 365)),
            ];
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Generate English title for slug
        $titleEn = $this->faker->sentence(rand(1, 8));

        // English
        $fakerEn = \Faker\Factory::create('en_US');

        // French
        $fakerFr = \Faker\Factory::create('fr_FR');

        // Arabic
        $fakerAr = \Faker\Factory::create('ar_SA');

        return [
            'title' => [
                'en' => $titleEn,
                'fr' => $fakerFr->sentence(rand(1, 8)),
                'ar' => $fakerAr->sentence(rand(1, 8)),
            ],
            'slug' => Str::slug($titleEn),
            'status' => 'Draft',
            'content' => [
                'en' => [
                    [
                        'bg_color' => '',
                        'blocks' => [
                            [
                                'type' => 'rich-text',
                                'data' => [
                                    'content' => '<h1>' . Str::title($fakerEn->words(rand(3, 8), true)) . '</h1><p>' . collect($fakerEn->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p><h2>' . Str::title($fakerEn->words(rand(3, 8), true)) . '</h2><p>' . collect($fakerEn->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p>',
                                ],
                            ],
                        ],
                    ]
                ],
                'fr' => [
                    [
                        'bg_color' => '',
                        'blocks' => [
                            [
                                'type' => 'rich-text',
                                'data' => [
                                    'content' => '<h1>' . Str::title($fakerFr->words(rand(3, 8), true)) . '</h1><p>' . collect($fakerFr->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p><h2>' . Str::title($fakerFr->words(rand(3, 8), true)) . '</h2><p>' . collect($fakerFr->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p>',
                                ],
                            ],
                        ],
                    ]
                ],
                'ar' => [
                    [
                        'bg_color' => '',
                        'blocks' => [
                            [
                                'type' => 'rich-text',
                                'data' => [
                                    'content' => '<h1>' . Str::title($fakerAr->words(rand(3, 8), true)) . '</h1><p>' . collect($fakerAr->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p><h2>' . Str::title($fakerAr->words(rand(3, 8), true)) . '</h2><p>' . collect($fakerAr->paragraphs(rand(1, 6)))->implode('</p><p>') . '</p>',
                                ],
                            ],
                        ],
                    ]
                ],
            ],
            'author_id' => User::inRandomOrder()->first()->id,
            'topic_id' => Topic::inRandomOrder()->first()->id,
        ];
    }
}
