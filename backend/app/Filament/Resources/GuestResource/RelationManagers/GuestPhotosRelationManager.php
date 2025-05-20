<?php

namespace App\Filament\Resources\GuestResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GuestPhotosRelationManager extends RelationManager
{
    protected static string $relationship = 'guestPhotos';

    protected static ?string $title = '写真';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('photo_path')
                    ->label('画像')
                    ->disk('s3')
                    ->moveFiles()
                    // 商品バリエーションコードをディレクトリとする
                    ->directory(fn (callable $get) => 'guest_photos/'.$this->ownerRecord->name)
                    ->image()
                    ->openable()
                    ->downloadable()
                    ->preserveFilenames()
                    ->visibility('private')
                    // 3MG
                    ->maxSize(3 * 1024)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // 写真を表示
                Tables\Columns\ImageColumn::make('photo_path')
                    ->label('ゲスト写真')
                    ->disk('s3')
                    ->visibility('private')
                    ->size(150),
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
