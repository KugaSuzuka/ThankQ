<?php

namespace Tests\Feature;

use App\Models\Guest;
use App\Models\Quiz;
use App\Models\QuizChoice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuizAnswerControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function test_store()
    {
        /** @var Guest $guest */
        $guest = Guest::factory()->create();
        /** @var Quiz $quiz */
        $quiz = Quiz::factory()
            ->count(4)
            ->has(QuizChoice::factory()
                ->count(4)
                ->sequence(
                    [
                        'choice_text' => '選択肢1',
                        'is_correct' => true,
                    ],
                    [
                        'choice_text' => '選択肢2',
                        'is_correct' => false,

                    ],
                    [
                        'choice_text' => '選択肢3',
                        'is_correct' => false,
                    ],
                    [
                        'choice_text' => '選択肢4',
                        'is_correct' => false,
                    ],
                )
            )
            ->create();
        $postData = [
            'quiz_choice_ids' => [
                $quiz->map(fn (Quiz $quiz) => $quiz->quizChoices()->inRandomOrder()->first()->id)->toArray(),
            ],
            'guest_id' => $guest->id,
        ];
        $this->postJson('/api/quiz-answers', $postData)
            ->assertOk()
            ->tap(function ($response) {
                // echo __METHOD__.'()#L'.__LINE__.':'.json_encode($response->json('data'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).PHP_EOL;
            })
            ->assertJson([
                'result' => true,
                'message' => '回答が登録されました！',
            ]);
        $this
            ->assertDatabaseHas('quiz_answers', [
                'guest_id' => $guest->id,
            ]);
        $this->assertDatabaseCount('quiz_answers', 4);
    }
}
