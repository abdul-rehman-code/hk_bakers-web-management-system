<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
{
    $product = $this->record;

    \App\Models\Activity::log(
        'Product Updated',
        "Product '{$product->name}' details or stock were updated."
    );
}
protected function afterDelete(): void
{
    \App\Models\Activity::log(
        'Product Deleted',
        "A product was removed from the bakery system."
    );
}
}
