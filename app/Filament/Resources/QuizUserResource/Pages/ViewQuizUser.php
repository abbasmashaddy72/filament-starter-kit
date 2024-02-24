<?php

namespace App\Filament\Resources\QuizUserResource\Pages;

use App\Filament\Resources\QuizUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewQuizUser extends ViewRecord
{
    protected static string $resource = QuizUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
