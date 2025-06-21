<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestResource\Pages;
use App\Filament\Resources\GuestResource\RelationManagers\GuestPhotosRelationManager;
use App\Models\Guest;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class GuestResource extends Resource
{
    protected static ?string $model = Guest::class;

    protected static ?string $modelLabel = 'ゲスト';

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $user = Auth::user(); // ログインしているユーザー取得

        return parent::getEloquentQuery()
            ->where('wedding_id', $user->wedding_id); // ユーザーのwedding_idと一致するゲストだけ取得
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('ゲスト氏名')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->label('招待者')
                    ->required(),
                Forms\Components\Textarea::make('message_from_groom')
                    ->label('新郎からのメッセージ')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('message_from_bride')
                    ->label('新婦からのメッセージ')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('ゲスト氏名'),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->label('招待者')
                    ->sortable(),
                Tables\Columns\TextColumn::make('message_from_groom')
                    ->label('新郎からのメッセージ')
                    ->width('200px')
                    ->wrapHeader()
                    ->wrap(),
                Tables\Columns\TextColumn::make('message_from_bride')
                    ->label('新婦からのメッセージ')
                    ->width('200px')
                    ->wrapHeader()
                    ->wrap(),
                Tables\Columns\TextColumn::make('access_token')
                    ->label('URL')
                    ->formatStateUsing(fn (string $state): string => 'https://thankq-wedding.com/#/' . $state)
                    ->copyable()
                    ->copyableState(fn (string $state): string => 'https://thankq-wedding.com/#/' . $state)
                    ->width('300px'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GuestPhotosRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGuests::route('/'),
            'create' => Pages\CreateGuest::route('/create'),
            'edit' => Pages\EditGuest::route('/{record}/edit'),
        ];
    }
}
