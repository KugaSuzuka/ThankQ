<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Wedding;
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
            'wedding_id' => Wedding::factory(),
            'access_token' => Str::uuid(),
            'message_from_groom' => fake()->realText(100),
            'message_from_bride' => fake()->realText(100),
        ];
    }
}
