<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\QuizChoice;
use Illuminate\Database\Seeder;

class QuizChoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quiz::all()
            ->each(function ($quiz) {
                QuizChoice::factory()
                    ->count(4)
                    ->sequence(
                        ['choice_text' => '選択肢1', 'is_correct' => true],
                        ['choice_text' => '選択肢2', 'is_correct' => false],
                        ['choice_text' => '選択肢3', 'is_correct' => false],
                        ['choice_text' => '選択肢4', 'is_correct' => false],
                    )
                    ->create([
                        'quiz_id' => $quiz->id,
                    ]);
            });
    }
}
