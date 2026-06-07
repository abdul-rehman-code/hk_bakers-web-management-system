<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
// use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function afterCreate(): void
{
    $user = $this->record;

    \App\Models\Activity::log(
        'User Created',
        "New user '{$user->name}' (Email: {$user->email}) has been registerd."
    );
}
}
