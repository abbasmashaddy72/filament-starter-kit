<?php

namespace App\Filament\Resources\QuizUserResource\Pages;

use App\Filament\Resources\QuizUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizUser extends EditRecord
{
    protected static string $resource = QuizUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
