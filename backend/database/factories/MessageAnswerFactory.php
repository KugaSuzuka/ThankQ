<?php

namespace Database\Factories;

use App\Models\Guest;
use App\Models\MessageQuestion;
use App\Models\Wedding;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MessageAnswer>
 */
class MessageAnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'guest_id' => Guest::factory(),
            'message_question_id' => MessageQuestion::factory(),
            'answer_text' => fake()->realText(100),
        ];
    }
}
