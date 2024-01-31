<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewArticle extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\LocaleSwitcher::make(),
        ];
    }
}
