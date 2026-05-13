<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use App\Filament\Resources\CategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
{
    // $this->record mein updated data hota hai
    $category = $this->record;

    \App\Models\Activity::log(
        'Category Updated',
        "Category '{$category->name}' has updated."
    );
}
    protected function afterDelete(): void
{
    // Yahan record delete ho chuka hota hai, isliye hum title manually de dete hain
    \App\Models\Activity::log(
        'Category Deleted',
        "One category has been deleted."
    );
}

}
