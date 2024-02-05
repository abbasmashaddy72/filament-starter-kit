<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;

class Tabs
{
    public static function make(): Block
    {
        return Block::make('tabs')
            ->schema([
                Select::make('data')
                    ->searchable()
                    ->native(false)
                    ->options(config('main.models')),
                TextInput::make('count')
                    ->numeric(),
                Repeater::make('items')
                    ->defaultItems(1)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Builder::make('content')
                            ->blocks([
                                RichText::make('simple'),
                            ]),
                    ]),
            ]);
    }
}
