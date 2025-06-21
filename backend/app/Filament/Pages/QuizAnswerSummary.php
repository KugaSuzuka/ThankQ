<?php

// app/Filament/Pages/QuizAnswerSummary.php

namespace App\Filament\Pages;

use App\Models\Guest;
use App\Models\QuizAnswer;
use Filament\Pages\Page;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class QuizAnswerSummary extends Page implements Tables\Contracts\HasTable
{
    use Tables\Concerns\InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static string $view = 'filament.pages.quiz-answer-summary';

    protected static ?string $navigationLabel = 'クイズ正解集計';

    protected static ?string $title = 'クイズ正解集計';

    public static function canAccess(): bool
    {
        return true;          // まずは全員許可で動作確認
        // 本番で制限したい場合はロール等で判定:
        // return auth()->user()?->role === 'groom';
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->query(
                Guest::with('quizAnswers.quizChoice.quiz')
                    ->leftJoin('quiz_answers', 'guests.id', '=', 'quiz_answers.guest_id')
                    ->leftJoin('quiz_choices', 'quiz_answers.quiz_choice_id', '=', 'quiz_choices.id')
                    ->select('guests.*')
                    ->selectRaw('SUM(CASE WHEN quiz_choices.is_correct = 1 THEN 1 ELSE 0 END) as correct_count')
                    ->groupBy('guests.id')
                    ->orderBy('correct_count', 'desc')
            )
            ->columns([
                TextColumn::make('name')
                    ->label('ゲスト名'),

                TextColumn::make('correct_count')
                    ->label('正解数')
                    ->state(function (Guest $record) {
                        return $record->quizAnswers
                            ->filter(fn (QuizAnswer $quizAnswer) => $quizAnswer->quizChoice->is_correct)
                            ->count();
                    })
                    ->color(function (Guest $record) {
                        $correctCount = $record->quizAnswers
                            ->filter(fn (QuizAnswer $quizAnswer) => $quizAnswer->quizChoice->is_correct)
                            ->count();

                        // 全ユーザーの正解数を取得して順位を判定
                        $allCorrectCounts = Guest::with('quizAnswers.quizChoice')
                            ->get()
                            ->map(function ($guest) {
                                return $guest->quizAnswers
                                    ->filter(fn (QuizAnswer $quizAnswer) => $quizAnswer->quizChoice->is_correct)
                                    ->count();
                            })
                            ->sortDesc()
                            ->unique()
                            ->values();

                        $rank = $allCorrectCounts->search($correctCount) + 1;

                        return match ($rank) {
                            1 => 'warning', // 1位：金色
                            2 => 'gray',    // 2位：銀色
                            3 => 'danger',  // 3位：銅色
                            default => null,
                        };
                    }),

                // 1問目
                TextColumn::make('quizAnswers.0.quizChoice.is_correct')
                    ->label('1問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),

                // 2問目
                TextColumn::make('quizAnswers.1.quizChoice.is_correct')
                    ->label('2問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),

                // 3問目
                TextColumn::make('quizAnswers.2.quizChoice.is_correct')
                    ->label('3問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),

                // 4問目
                TextColumn::make('quizAnswers.3.quizChoice.is_correct')
                    ->label('4問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),
                // 5問目
                TextColumn::make('quizAnswers.4.quizChoice.is_correct')
                    ->label('5問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),
                // 6問目
                TextColumn::make('quizAnswers.5.quizChoice.is_correct')
                    ->label('6問目')
                    ->formatStateUsing(fn ($state) => $state ? '○' : '✕'),
            ]);
    }
}
