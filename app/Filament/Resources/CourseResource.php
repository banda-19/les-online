<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CourseResource\Pages;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class CourseResource extends Resource
{
    protected static ?string $model = Course::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap'; // Ikon di sidebar

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Field untuk Judul Kursus
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    // live() dan afterStateUpdated() untuk membuat slug otomatis
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                // Field untuk Slug (read-only saat edit)
                Forms\Components\TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->disabled()
                    ->dehydrated() // memastikan field ini tetap disimpan meski disabled
                    ->unique(Course::class, 'slug', ignoreRecord: true),

                // Field untuk Thumbnail (Upload Gambar)
                Forms\Components\FileUpload::make('thumbnail')
                    ->image() // Hanya menerima file gambar
                    ->directory('thumbnails'), // Simpan di storage/app/public/thumbnails

                // Field untuk Deskripsi
                Forms\Components\RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(), // Agar field ini memakai lebar penuh
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk ID, bisa di-sort
                Tables\Columns\TextColumn::make('id')
                    ->sortable(),

                // Kolom untuk Thumbnail
                Tables\Columns\ImageColumn::make('thumbnail'),

                // Kolom untuk Judul, bisa dicari dan di-sort
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk Slug
                Tables\Columns\TextColumn::make('slug'),
            ])
            ->filters([
                //
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCourses::route('/'),
            'create' => Pages\CreateCourse::route('/create'),
            'edit' => Pages\EditCourse::route('/{record}/edit'),
        ];
    }
}