<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuizAnswerRequest;
use App\Models\QuizAnswer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QuizAnswerController extends Controller
{
    public function store(StoreQuizAnswerRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                collect(request()->input('quiz_choice_ids'))
                    ->flatten()
                    ->each(function (int $quizChoiceId) use ($request) {

                        // すでに回答済みの場合はスキップ
                        if (QuizAnswer::where('guest_id', $request->input('guest_id'))
                            ->whereHas('quizChoice', fn ($query) => $query->where('id', $quizChoiceId))
                            ->exists()) {
                            return;
                        } else {
                            QuizAnswer::create([
                                'guest_id' => $request->input('guest_id'),
                                'quiz_choice_id' => $quizChoiceId,
                            ]);
                        }
                    });
            });

            return response()->json([
                'message' => '回答が登録されました！',
                'result' => true,
            ], 200);
        } catch (\Exception $e) {
            Log::error('QuizAnswer 登録失敗: '.$e->getMessage());

            return response()->json([
                'message' => '登録に失敗しました。お手数ですが再度お試しください。',
                'result' => false,
            ], 500);
        }
    }
}
