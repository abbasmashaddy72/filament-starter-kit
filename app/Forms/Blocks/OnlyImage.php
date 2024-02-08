<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class OnlyImage
{
    public static function make(): Block
    {
        return Block::make('only-image')
            ->schema([
                Group::make()->schema([
                    TextInput::make('title'),
                    Textarea::make('message'),
                    TextInput::make('video_url'),
                    CuratorPicker::make('image')
                        ->label('Image')
                        ->lazyLoad()
                        ->listDisplay()
                        ->constrained(true)
                        ->visible(),
                    TextInput::make('button_text'),
                    TextInput::make('button_url'),
                ])->columns(2),
            ]);
    }
}
