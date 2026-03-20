<?php

namespace App\Filament\Resources\Posts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PostsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make("image")->disk("public"),
                                                         //  php artisan storage:link
                TextColumn::make("title")->sortable()->searchable(),
                TextColumn::make("slug")->sortable()->searchable(),
                // TextColumn::make("category_id"),
                TextColumn::make("category.name")->sortable()->searchable(),
                ColorColumn::make("color"),
                TextColumn::make("created_at")
                    ->label("Created At")
                    ->datetime()
                    ->sortable()
            ])->defaultSort("title","asc")

            ->filters([
                Filter::make("created_at")
                    ->label("Creation Date")
                    ->schema([
                        DatePicker::make("created_at")
                            ->label("Select Date:")
                    ])
                    ->query(function($query, $data){
                        return $query
                            ->when($data["created_at"],function($q, $date){
                                $q->whereDate("created_at",$date);
                            });

                    }),
                    SelectFilter::make("category_id")
                        ->label("Select Category")
                        ->relationship("category","name")
                        ->preload()
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
