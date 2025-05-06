<?php

namespace Database\Seeders;

use App\Models\Guest;
use App\Models\Quiz;
use App\Models\QuizAnswer;
use App\Models\QuizChoice;
use Illuminate\Database\Seeder;

class QuizAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::all()->each(function ($quiz) {
            Guest::all()
                ->each(function ($guest) use ($quiz) {
                    QuizAnswer::factory()
                        ->create([
                            'guest_id' => $guest->id,
                            'quiz_choice_id' => QuizChoice::where('quiz_id', $quiz->id)->inRandomOrder()->first()->id,
                        ]);
                });
        });
    }
}
