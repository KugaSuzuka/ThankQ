<?php

use App\Http\Controllers\GuestController;
use App\Http\Controllers\QuizAnswerController;
use App\Http\Controllers\QuizController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// ゲストメッセージ
Route::get('guests/{access_token}', [GuestController::class, 'show']);
// クイズ一覧を返す
Route::get('quizzes/{wedding_id}', [QuizController::class, 'index']);
// クイズ結果を送信する
Route::post('quiz-answers', [QuizAnswerController::class, 'store']);
