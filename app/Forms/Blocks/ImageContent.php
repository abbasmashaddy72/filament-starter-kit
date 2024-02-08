<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class ImageContent
{
    public static function make(): Block
    {
        return Block::make('image-content')
            ->schema([
                Group::make()->schema([
                    Select::make('data')
                        ->searchable()
                        ->native(false)
                        ->options(config('main.models')),
                    TextInput::make('count')
                        ->numeric(),
                    TextInput::make('title')
                        ->required(),
                    Textarea::make('message'),
                    CuratorPicker::make('image')
                        ->label('Image'),
                ])->columns(2),
            ]);
    }
}
