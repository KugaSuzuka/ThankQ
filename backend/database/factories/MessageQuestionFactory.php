<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\MessageQuestion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageQuestion>
 */
class MessageQuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'wedding_id' => 1,
            'question' => fake()->realText(50),
        ];
    }
}
