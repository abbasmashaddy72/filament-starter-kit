<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;

class Accordion
{
    public static function make(): Block
    {
        return Block::make('accordion')
            ->schema([
                Group::make()->schema([
                    TextInput::make('title')
                        ->required(),
                    Textarea::make('message'),
                    Select::make('data')
                        ->searchable()
                        ->native(false)
                        ->options(config('main.models')),
                    TextInput::make('count')
                        ->numeric(),
                ])->columns(2),
                Repeater::make('items')
                    ->defaultItems(0)
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        TiptapEditor::make('content')
                            ->profile('minimal')
                            ->required(),
                    ])->grid([
                        'default' => 1,
                        'md' => 2,
                        'xl' => 3,
                        '2xl' => 3,
                    ]),
            ]);
    }
}
