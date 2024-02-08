<?php

namespace App\Forms\Blocks;

use LaraZeus\Bolt\Models\Form;
use Filament\Forms\Components\Select;
use FilamentTiptapEditor\TiptapEditor;
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
                Select::make('type')
                    ->options([
                        'content' => 'Content',
                        'image' => 'Image',
                        'contact_details' => 'Contact Details',
                    ])
                    ->native(false),
                TiptapEditor::make('content')
                    ->profile('default'),
                Select::make('form_name')
                    ->searchable()
                    ->preload()
                    ->options(Form::all()->pluck('name', 'slug')),
            ]);
    }
}
