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
            QuizAnswer::factory()
                ->count(Guest::all()->count() + Quiz::all()->count())
                ->recycle(QuizChoice::all())
                ->recycle(Guest::all())
                ->create();
        });
    }
}
