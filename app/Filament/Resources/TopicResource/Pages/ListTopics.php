<?php

namespace App\Filament\Resources\TopicResource\Pages;

use App\Filament\Resources\TopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopics extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = TopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
