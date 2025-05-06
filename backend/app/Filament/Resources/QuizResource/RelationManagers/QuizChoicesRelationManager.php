<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\Radio;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizChoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'quizChoices';
    protected static ?string $title = '選択肢';


    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('choice_text')
                    ->required()
                    ->label('選択肢')
                    ->maxLength(255),
                Radio::make('is_correct')
                    ->label('正解？')
                    ->options([
                        1 => '正解',
                        0 => '不正解',
                    ])
                    ->inline() // ラジオボタンを横並びにする（縦並びにしたいなら消してOK）
                    ->default(0) // デフォルトは不正解
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('choice_text')
            ->columns([
                Tables\Columns\TextColumn::make('choice_text')
                    ->label('選択肢')
                    ->searchable()
                    ->sortable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('is_correct')
                    ->label('正解か？')
                    ->badge()
                    ->formatStateUsing(fn ($state) => $state ? '正解' : '不正解')
                    ->color(fn ($state) => $state ? 'success' : 'danger'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
