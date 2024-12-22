<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PostResource\Pages;
use App\Models\Category;
use App\Models\Post;
use App\PostStatus;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('title')
                    ->columnSpanFull(),
                Forms\Components\RichEditor::make('content')
                    ->fileAttachmentsDirectory('attachments')
                    ->fileAttachmentsVisibility('public')
                    ->columnSpanFull(),
                Forms\Components\Select::make('catecoty.name')
                    ->required()
                    ->label('Category')
                    ->options(Category::whereNull('parent_id')->get()->pluck('name', 'id'))
                    ->searchable(),
                Forms\Components\Toggle::make('is_comment')
                    ->required(),
                Forms\Components\Toggle::make('is_featured')
                    ->required(),
                Forms\Components\TagsInput::make('seo_tags')
                    ->columnSpanFull()
                    ->separator(','),
                Forms\Components\TextInput::make('seo_summery')
                    ->maxLength(160)
                    ->default(null),
                Forms\Components\TextInput::make('thumbnail')
                    ->maxLength(255)
                    ->default(null),
                Forms\Components\Select::make('status')
                    ->options(PostStatus::class)
                    ->required(),
                Forms\Components\TextInput::make('admin_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('category_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_comment')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_featured')
                    ->boolean(),
                Tables\Columns\TextColumn::make('seo_summery')
                    ->searchable(),
                Tables\Columns\TextColumn::make('thumbnail')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('admin_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
