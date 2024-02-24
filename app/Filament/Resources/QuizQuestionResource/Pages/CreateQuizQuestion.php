<?php

namespace App\Filament\Resources\QuizQuestionResource\Pages;

use App\Filament\Resources\QuizQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateQuizQuestion extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = QuizQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
