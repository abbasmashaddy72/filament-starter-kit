<?php

namespace App\Filament\Resources\QuizTopicResource\Pages;

use App\Filament\Resources\QuizTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizTopics extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = QuizTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
