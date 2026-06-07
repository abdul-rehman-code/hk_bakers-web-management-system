<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
// use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;
    protected function afterCreate(): void
{
    $product = $this->record;

    \App\Models\Activity::log(
        'Product Created',
        "New product '{$product->name}' was added to the inventory."
    );
}
}
