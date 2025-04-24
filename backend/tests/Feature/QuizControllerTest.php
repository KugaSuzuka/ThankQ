<?php

namespace Tests\Feature;

use App\Models\Quiz;
use App\Models\QuizChoice;
use App\Models\Wedding;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class QuizControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @see QuizController::index()
     */
    public function test_index()
    {
        $wedding = Wedding::factory()
            ->has(Quiz::factory()
                ->count(3)
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
                ))
            ->create();
        $this
            ->getJson('/api/quizzes/'.$wedding->id)
            ->tap(function ($response) {
                echo __METHOD__.'()#L'.__LINE__.':'.json_encode($response->json('data'), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE).PHP_EOL;
            })
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'id' => $wedding->quizzes[0]->id,
                        'question' => $wedding->quizzes[0]->question,
                        'quiz_choices' => [
                            [
                                'id' => $wedding->quizzes[0]->quizChoices[0]->id,
                                'choice' => $wedding->quizzes[0]->quizChoices[0]->choice_text,
                            ],
                            [
                                'id' => $wedding->quizzes[0]->quizChoices[1]->id,
                                'choice' => $wedding->quizzes[0]->quizChoices[1]->choice_text,
                            ],
                            [
                                'id' => $wedding->quizzes[0]->quizChoices[2]->id,
                                'choice' => $wedding->quizzes[0]->quizChoices[2]->choice_text,
                            ],
                            [
                                'id' => $wedding->quizzes[0]->quizChoices[3]->id,
                                'choice' => $wedding->quizzes[0]->quizChoices[3]->choice_text,
                            ],
                        ],
                    ],
                ],
            ]);
    }
}
