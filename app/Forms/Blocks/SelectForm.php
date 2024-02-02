<?php

namespace App\Forms\Blocks;

use LaraZeus\Bolt\Models\Form;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Builder\Block;
use Awcodes\Curator\Components\Forms\CuratorPicker;

class SelectForm
{
    public static function make(): Block
    {
        return Block::make('form')
            ->schema([
                TextInput::make('title')
                    ->required(),
                Textarea::make('message'),
                Repeater::make('items')
                    ->schema([
                        CuratorPicker::make('image')
                            ->label('Image'),
                        Select::make('image_location')
                            ->options([
                                'left' => 'Left',
                                'right' => 'Right',
                            ])
                            ->native(false),
                        TextInput::make('title')
                            ->required(),
                        Select::make('content')
                            ->searchable()
                            ->options(Form::all()->pluck('name', 'slug')),
                    ])->columns(2),
            ]);
    }
}
