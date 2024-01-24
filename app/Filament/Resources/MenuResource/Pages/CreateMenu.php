<?php

namespace App\Filament\Resources\MenuResource\Pages;

use Filament\Actions;
use App\Filament\Resources\MenuResource;
use Filament\Resources\Pages\CreateRecord;
use Filament\Resources\Concerns\Translatable;

class CreateMenu extends CreateRecord
{
    use Translatable;

    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
