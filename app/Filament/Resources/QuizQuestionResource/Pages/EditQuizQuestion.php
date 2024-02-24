<?php

namespace App\Filament\Resources\QuizQuestionResource\Pages;

use App\Filament\Resources\QuizQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditQuizQuestion extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = QuizQuestionResource::class;

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
