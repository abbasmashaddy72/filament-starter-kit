<?php

namespace App\Filament\Resources\QuizTopicResource\Pages;

use App\Filament\Resources\QuizTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuizTopic extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = QuizTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
