<?php

namespace App\Filament\Resources\CourseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class LessonsRelationManager extends RelationManager
{
    protected static string $relationship = 'lessons';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Kita tidak perlu lagi field course_id di sini!

                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated()
                    ->unique(ignoreRecord: true),

                Forms\Components\TextInput::make('duration_in_minutes')
                    ->required()
                    ->numeric(),

                Forms\Components\Radio::make('type')
                    ->options([
                        'video' => 'Video',
                        'artikel' => 'Artikel',
                    ])
                    ->required()
                    ->live(),

                Forms\Components\TextInput::make('content')
                    ->label('URL Video Embed')
                    ->required()
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'video'),

                Forms\Components\RichEditor::make('content')
                    ->label('Isi Artikel')
                    ->required()
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'artikel')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
                Tables\Columns\IconColumn::make('type')
                    ->icon(fn (string $state): string => match ($state) {
                        'video' => 'heroicon-o-video-camera',
                        'artikel' => 'heroicon-o-document-text',
                    }),
                Tables\Columns\TextColumn::make('duration_in_minutes')
                    ->label('Durasi (Menit)'),
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