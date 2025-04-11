<?php

namespace Database\Factories;

use App\Models\BrideGroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Guest>
 */
class GuestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => User::factory(),
            'access_token' => Str::uuid(),
            'thank_message' => fake()->realText(100),
            'photo_path' => 'guest_photos/sample.jpg',
        ];
    }
}
