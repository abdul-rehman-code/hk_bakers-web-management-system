<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VisitorStats extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            // Stat::make('Total Registered Users', User::count())
            //     ->description('People who joined your bakery')
            //     ->descriptionIcon('heroicon-m-users')
            //     ->color('success'),

            // Stat::make('New Customers (This Month)', User::whereMonth('created_at', now()->month)->count())
            //     ->color('info'),
        ];
    }
}
