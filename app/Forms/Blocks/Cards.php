<?php

namespace App\Forms\Blocks;

use Filament\Forms\Get;
use LaraZeus\Bolt\Models\Form;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use FilamentTiptapEditor\TiptapEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
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
                ])->columns(2),
                Repeater::make('items')
                    ->schema([
                        TextInput::make('title')
                            ->required(),
                        Group::make()->schema([
                            TextInput::make('button_text'),
                            TextInput::make('button_url'),
                            CuratorPicker::make('image')
                                ->label('Image'),
                            Select::make('image_location')
                                ->options([
                                    'left' => 'Left',
                                    'right' => 'Right',
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
