<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Models\Lesson;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Filament\Resources\CourseResource\RelationManagers;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationIcon = 'heroicon-o-film';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Dropdown untuk memilih kursus induk
                Forms\Components\Select::make('course_id')
                    ->relationship('course', 'title') // Menampilkan judul kursus
                    ->searchable() // Agar bisa dicari
                    ->preload() // Memuat opsi saat halaman dibuka
                    ->required(),

                // Field untuk Judul Materi
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                // Field untuk Slug
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated()
                    ->unique(Lesson::class, 'slug', ignoreRecord: true),

                // Field untuk Durasi
                Forms\Components\TextInput::make('duration_in_minutes')
                    ->required()
                    ->numeric(),

                // Pilihan Tipe Materi: Video atau Artikel
                Forms\Components\Radio::make('type')
                    ->options([
                        'video' => 'Video',
                        'artikel' => 'Artikel',
                    ])
                    ->required()
                    ->live(), // ->live() agar form bereaksi saat pilihan diubah

                // Field untuk Konten Video (HANYA MUNCUL JIKA TIPE = 'video')
                Forms\Components\TextInput::make('content')
                    ->label('URL Video Embed')
                    ->required()
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'video'),

                // Field untuk Konten Artikel (HANYA MUNCUL JIKA TIPE = 'artikel')
                Forms\Components\RichEditor::make('content')
                    ->label('Isi Artikel')
                    ->required()
                    ->visible(fn (Forms\Get $get): bool => $get('type') === 'artikel')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                // Menampilkan judul materi, dengan link ke halaman edit
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                // Menampilkan judul kursus induknya
                Tables\Columns\TextColumn::make('course.title')
                    ->sortable(),
                // Menampilkan ikon sesuai tipe materi
                Tables\Columns\IconColumn::make('type')
                    ->icon(fn (string $state): string => match ($state) {
                        'video' => 'heroicon-o-video-camera',
                        'artikel' => 'heroicon-o-document-text',
                    }),
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
        // Daftarkan di sini
        RelationManagers\LessonsRelationManager::class,
    ];
}
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
    
}