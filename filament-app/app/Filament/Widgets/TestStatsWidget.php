<?php

namespace App\Filament\Widgets;

use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TestStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make("Total Users", 1200)
            Stat::make("Total Users", User::count())
                ->description("Total number of users of this year")
                ->descriptionIcon(Heroicon::ArrowUpLeft,IconPosition::Before)
                ->chart(
                    //[ 2, 4, 6, 7, 12, 15, 17 ]
                    User::selectRaw("MONTH(created_at) as month, COUNT(*) as count")
                        ->whereYear("created_at", now()->year)
                        ->groupBy("month")
                        ->orderBy("month")
                        ->pluck("count")
                        ->toArray()
                )
                ->descriptionColor("success")
                ->color("success"),
            Stat::make("Total Posts", Post::count())
                ->description("Total number of posts of this year")
                ->descriptionIcon(Heroicon::ArrowUpLeft,IconPosition::Before)
                ->chart(
                    //[ 2, 4, 6, 7, 12, 15, 17 ]
                    User::selectRaw("MONTH(created_at) as month, COUNT(*) as count")
                        ->whereYear("created_at", now()->year)
                        ->groupBy("month")
                        ->orderBy("month")
                        ->pluck("count")
                        ->toArray()
                )
                ->descriptionColor("warning")
                ->color("warning"),
            Stat::make("Total Products", Product::count())
                ->description("Total number of products of this year")
                ->descriptionIcon(Heroicon::ArrowUpLeft,IconPosition::Before)
                ->chart(
                    //[ 2, 4, 6, 7, 12, 15, 17 ]
                    User::selectRaw("MONTH(created_at) as month, COUNT(*) as count")
                        ->whereYear("created_at", now()->year)
                        ->groupBy("month")
                        ->orderBy("month")
                        ->pluck("count")
                        ->toArray()
                )
                ->descriptionColor("info")
                ->color("info")
        ];
    }
}
