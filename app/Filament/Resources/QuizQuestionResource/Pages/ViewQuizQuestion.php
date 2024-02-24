<?php

namespace App\Filament\Resources\QuizQuestionResource\Pages;

use App\Filament\Resources\QuizQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuizQuestion extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = QuizQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
