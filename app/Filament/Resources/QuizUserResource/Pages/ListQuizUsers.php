<?php

namespace App\Filament\Resources\QuizUserResource\Pages;

use App\Filament\Resources\QuizUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListQuizUsers extends ListRecords
{
    protected static string $resource = QuizUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
