<?php

namespace Database\Factories;

use App\Domains\Book\Models\Book;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'isbn' => $this->faker->numberBetween(),
            'value' => $this->faker->randomFloat(),
        ];
    }
}
