<?php

namespace App\Filament\Resources\FaqResource\Pages;

use App\Filament\Resources\FaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewFaq extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = FaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
