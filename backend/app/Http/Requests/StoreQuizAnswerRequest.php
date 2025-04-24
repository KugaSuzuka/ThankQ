<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQuizAnswerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'quiz_choice_ids' => [
                'required',
                'array',
                'min:1',
            ],
            'quiz_choice_ids.*' => [
                'required',
                Rule::exists('quiz_choices', 'id'),
            ],
            'guest_id' => [
                'required',
                Rule::exists('guests', 'id'),
            ],
        ];
    }

    public function attributes(): array
    {
        return [
            'quiz_choice_ids.*' => 'クイズ選択肢',
            'guest_id' => 'ゲスト',
        ];
    }
}
