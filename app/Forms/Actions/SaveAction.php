<?php

namespace App\Forms\Actions;

use Filament\Actions\Action;

class SaveAction extends Action
{
    public static function getDefaultName(): ?string
    {
        return 'saveRecord';
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('Save'));

        $this->color('primary');

        $this->groupedIcon('icons.save');

        $this->action('save');
    }
}
