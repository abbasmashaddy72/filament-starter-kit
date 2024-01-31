<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTopic extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = TopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
