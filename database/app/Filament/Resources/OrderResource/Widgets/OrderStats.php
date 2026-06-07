<?php

namespace App\Filament\Resources\OrderResource\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::where('status', 'delivered')->sum('total_price');
        return [
            Stat::make('Total Orders', Order::count())
                ->description('Overall orders in system')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('info'),

            Stat::make('Pending', Order::where('status', 'pending')->count())
                ->description('New orders waiting')
                ->descriptionIcon('heroicon-m-clock')
                ->color('gray'),

            Stat::make('Baking', Order::where('status', 'baking')->count())
                ->description('Currently in oven')
                ->descriptionIcon('heroicon-m-fire')
                ->color('warning'),

            Stat::make('Dispatched', Order::where('status', 'dispatched')->count())
                ->description('Out for delivery')
                ->descriptionIcon('heroicon-m-truck')
                ->color('info'),

            Stat::make('Delivered', Order::where('status', 'delivered')->count())
                ->description('Completed orders')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Cancelled', Order::where('status', 'cancelled')->count())
                ->description('Rejected/Cancelled')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),
             Stat::make('Total Revenue', 'Rs. ' . number_format($totalRevenue, 2))
            ->description('Total earnings from delivered orders')
            ->descriptionIcon('heroicon-m-banknotes')
            ->chart([7, 2, 10, 3, 15, 4, 17]) // Ye aik chota sa graph bhi dikhaye ga
            ->color('success'),
        ];
    }
}
