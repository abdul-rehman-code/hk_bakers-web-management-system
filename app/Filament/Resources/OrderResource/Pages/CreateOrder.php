<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Activity;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;
    protected function afterCreate(): void
    {
        // $this->record mein saara data hota hai jo abhi save hua
        $order = $this->record;

        Activity::log(
            'New Order',
            "Order #{$order->id} was placed by a customer."
        );
    }
}
