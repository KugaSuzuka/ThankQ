<?php

namespace App\Filament\Resources\QuizResource\Pages;

use App\Filament\Resources\QuizResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateQuiz extends CreateRecord
{
    protected static string $resource = QuizResource::class;

    // 新規作成時にアクセストークンを作成する
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['wedding_id'] = Auth::user()->wedding_id; // ログインユーザーのwedding_idを設定
        return $data;
    }
}
