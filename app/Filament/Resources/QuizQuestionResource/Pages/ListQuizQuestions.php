<?php

namespace App\Filament\Resources\QuizQuestionResource\Pages;

use App\Filament\Resources\QuizQuestionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizQuestions extends ListRecords
{
    use ListRecords\Concerns\Translatable;

    protected static string $resource = QuizQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
