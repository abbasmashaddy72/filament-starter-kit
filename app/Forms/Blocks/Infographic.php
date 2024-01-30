<?php

namespace App\Forms\Blocks;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Textarea;
use FilamentCurator\Forms\Components\MediaPicker;
use Awcodes\Curator\Models\Media;

class Infographic
{
    public static function make(): Block
    {
        return Block::make('infographic')
            ->schema([
                CuratorPicker::make('image')
                    ->label('Image'),
                Textarea::make('transcript')
                    ->label('Transcript'),
            ]);
    }
}
