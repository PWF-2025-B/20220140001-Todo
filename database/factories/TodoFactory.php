<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Todo>
 */
class TodoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => rand(1, 100),
            'title' => ucwords($this->faker->sentence()),
            'is_complete' => rand(0, 1), // sesuai model
            // Membuat relasi category dengan random category id dari tabel categories
            'category_id' => Category::inRandomOrder()->first()?->id ?? null,
        ];
    }
}