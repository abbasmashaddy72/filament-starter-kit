<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class ImageText
{
    public static function make(): Block
    {
        return Block::make('image-text')
            ->schema([
                Group::make()->schema([
                    TextInput::make('title')
                        ->required(),
                    CuratorPicker::make('image')
                        ->label('Image')
                        ->lazyLoad()
                        ->listDisplay()
                        ->constrained(true)
                        ->visible(),
                    Select::make('image_location')
                        ->options([
                            'left' => 'Left',
                            'right' => 'Right',
                        ])
                        ->native(false),
                    TiptapEditor::make('content')
                        ->profile('default')
                        ->columnSpanFull()
                        ->required(),
                ])->columns(3)
            ]);
    }
}
