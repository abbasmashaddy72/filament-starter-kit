<?php

namespace App\Concerns;

use Filament\Actions;
use App\Forms\Actions\PreviewAction;
use App\Forms\Actions\SaveAction;

trait HasCustomEditActions
{
    public function getActions(): array
    {
        return [
            SaveAction::make(),
            PreviewAction::make()->record($this->record),
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
