<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meta>
 */
class MetaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => Str::ucfirst($this->faker->words(rand(2, 6), true)),
            'description' => $this->faker->text,
            'indexable' => $this->faker->boolean,
            'og_image' => Media::inRandomOrder()->limit(1)->first()->id,
        ];
    }
}
