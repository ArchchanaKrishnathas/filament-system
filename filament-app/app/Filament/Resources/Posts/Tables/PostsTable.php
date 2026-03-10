<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("image")->disk("public"),
                                                         //  php artisan storage:link
                TextColumn::make("title")->sortable(),
                TextColumn::make("slug")->sortable(),
                // TextColumn::make("category_id"),
                TextColumn::make("category.name")->sortable(),
                ColorColumn::make("color"),
                TextColumn::make("created_at")
                    ->label("Created At")
                    ->datetime()
                    ->sortable()
            ])->defaultSort("title","asc")

            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
