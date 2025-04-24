<?php

namespace Tests\Unit\Requests;

use App\Http\Requests\StoreQuizAnswerRequest;
use App\Models\Guest;
use App\Models\QuizChoice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class StoreQuizAnswerRequestTest extends TestCase
{
    use DatabaseTransactions;

    private function getValidator(array $data)
    {
        $request = new StoreQuizAnswerRequest;
        $rules = $request->rules();
        $attributes = $request->attributes();

        return Validator::make($data, $rules, [], $attributes);
    }

    public function test_passes_with_valid_data()
    {
        $quizChoices = QuizChoice::factory()->count(3)->create();
        $validData = [
            'guest_id' => Guest::factory()->create()->id,
            'quiz_choice_ids' => $quizChoices->pluck('id')->flatten()->toArray(),
        ];

        $validator = $this->getValidator($validData);
        $this->assertTrue($validator->passes());
    }

    public function test_fails_when_guest_id_is_missing()
    {
        $invalidData = [
            'quiz_choice_ids' => [QuizChoice::factory()->create()->id],
        ];

        $validator = $this->getValidator($invalidData);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('guest_id', $validator->errors()->messages());
    }

    public function test_fails_when_quiz_choice_ids_is_missing()
    {
        $invalidData = [
            'guest_id' => Guest::factory()->create()->id,
        ];

        $validator = $this->getValidator($invalidData);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('quiz_choice_ids', $validator->errors()->messages());
    }

    public function test_fails_when_quiz_choice_ids_contains_null()
    {
        $invalidData = [
            'guest_id' => 1,
            'quiz_choice_ids' => [null],
        ];

        $validator = $this->getValidator($invalidData);
        $this->assertFalse($validator->passes());
        $this->assertArrayHasKey('quiz_choice_ids.0', $validator->errors()->messages());
    }
}
