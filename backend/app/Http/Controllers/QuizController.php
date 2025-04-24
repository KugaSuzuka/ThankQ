<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuizResource;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * 結婚式に紐づくクイズ一覧を取得する
     */
    public function index(Request $request, int $wedding_id): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return QuizResource::collection(
            Quiz::query()
                ->with(['quizChoices'])
                ->where('wedding_id', $wedding_id)
                ->get()
        );
    }
}
