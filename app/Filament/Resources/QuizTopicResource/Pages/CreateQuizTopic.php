<?php

namespace App\Filament\Resources\QuizTopicResource\Pages;

use App\Filament\Resources\QuizTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuizTopic extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = QuizTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
