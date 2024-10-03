<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->text(500),
            'birthdate' => $this->faker->date(),
            'author_image' => $this->faker->imageUrl(640, 480, 'people', true, 'Faker'),
        ];
    }
}
