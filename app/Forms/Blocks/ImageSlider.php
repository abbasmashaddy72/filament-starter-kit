<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Builder\Block;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class ImageSlider
{
    public static function make(): Block
    {
        return Block::make('image-slider')
            ->schema([
                CuratorPicker::make('image')
                    ->label('Image')
                    ->lazyLoad()
                    ->multiple()
                    ->listDisplay()
                    ->constrained(true)
                    ->visible(),
            ]);
    }
}
