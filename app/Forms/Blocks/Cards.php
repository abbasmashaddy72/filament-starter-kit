<?php

namespace App\Forms\Blocks;

use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class Cards
{
    public static function make(): Block
    {
        return Block::make('cards')
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
                    Select::make('image_location')
                        ->options([
                            'left' => 'Left',
                            'right' => 'Right',
                            'top' => 'Top',
                        ])
                        ->native(false),
                ])->columns(3),
                Repeater::make('items')
                    ->defaultItems(0)
                    ->schema([
                        Group::make()->schema([
                            TextInput::make('title')
                                ->required(),
                            IconPicker::make('icon')
                                ->sets(['remix'])
                                ->columns([
                                    'default' => 1,
                                    'lg' => 3,
                                    '2xl' => 5,
                                ]),
                            TextInput::make('button_text'),
                            TextInput::make('button_url'),
                            CuratorPicker::make('image')
                                ->label('Image'),
                            Select::make('image_location')
                                ->options([
                                    'left' => 'Left',
                                    'right' => 'Right',
                                    'top' => 'Top',
                                ])
                                ->native(false),
                        ])->columns(2),
                        TiptapEditor::make('content')
                            ->profile('minimal')
                            ->columnSpanFull()
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
