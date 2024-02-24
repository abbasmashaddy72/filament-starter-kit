<?php

namespace App\Filament\Resources\QuizTopicResource\Pages;

use App\Filament\Resources\QuizTopicResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizTopic extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = QuizTopicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
