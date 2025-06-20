<?php

namespace App\Filament\Resources\GuestResource\Pages;

use App\Filament\Resources\GuestResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CreateGuest extends CreateRecord
{
    protected static string $resource = GuestResource::class;

    // 新規作成時にアクセストークンを作成する
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['access_token'] = Str::uuid();
        $data['wedding_id'] = Auth::user()->wedding_id; // ログインユーザーのwedding_idを設定

        return $data;
    }
}
