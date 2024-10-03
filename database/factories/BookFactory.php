<?php

namespace Database\Factories;

use App\Models\Author;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'book_image' => $this->faker->imageUrl(640, 480, 'books', true, 'Faker'),
            'description' => $this->faker->paragraph(5),
            'price' => $this->faker->randomFloat(2, 5, 100),
            'language' => $this->faker->randomElement(['english', 'arabic', 'spanish']),
            'category_id' => Category::inRandomOrder()->first()->id,
            'author_id' => Author::inRandomOrder()->first()->id,
        ];
    }
}
