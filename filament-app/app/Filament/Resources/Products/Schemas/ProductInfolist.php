<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make("Product Info")
                    ->schema([
                        TextEntry::make("id")
                            ->label("Product ID")
                            ->weight("bold")
                            ->color("primary"),
                        TextEntry::make("name")
                            ->label("Product Name")
                            ->weight("bold")
                            ->color("primary"),
                        TextEntry::make("sku")
                            ->label("Product SKU")
                            ->weight("bold")
                            ->badge()
                            ->color("success"),
                        TextEntry::make("description")
                            ->label("Product Description")
                            ->weight("bold")
                            ->color("primary"),
                        TextEntry::make("created_at")
                            ->label("Product Creation Date")
                            ->weight("bold")
                            ->color("info")
                            ->date("m/d/Y"),
                    ])->columnSpanFull(),
                Section::make("Pricing & Stock")
                    ->schema([
                        TextEntry::make("price")
                            ->label("Product price")
                            ->weight("bold")
                            ->icon(Heroicon::CurrencyDollar)
                            ->color("primary"),
                        TextEntry::make("stock")
                            ->label("Product Stock")
                            ->weight("bold")
                            ->color("primary"),
                    ])->columnSpanFull(),
                Section::make("Media & Status")
                    ->schema([
                        ImageEntry::make("image")
                            ->label("Product Image")
                            ->disk("public"),
                        IconEntry::make("is_active")
                            ->label("Is Active?")
                            ->boolean(),
                        IconEntry::make("is_featured")
                            ->label("Is Featured?")
                            ->boolean()
                    ])->columnSpanFull()

            ]);
    }
}

