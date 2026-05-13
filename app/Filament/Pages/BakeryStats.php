<?php

namespace App\Filament\Pages;
use Illuminate\Support\Facades\DB;
use Filament\Pages\Page;

class BakeryStats extends Page
{
    protected static ?string $navigationIcon = 'heroicon-m-chart-bar';

    protected static string $view = 'filament.pages.bakery-stats';

    protected static ?string $navigationLabel = 'Analytics';

    protected static ?string $title = 'Report Analysis';

public function getStats(): array
{
    return [
        'top_products' => \App\Models\OrderItem::with('product')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderBy('total_sold', 'desc')
            ->take(5)
            ->get(),
    ];
}
public function getActivities()
{
    return \App\Models\Activity::with('user')
        ->latest()
        ->take(10) // Sirf top 10 dikhane ke liye
        ->get();
}
}
