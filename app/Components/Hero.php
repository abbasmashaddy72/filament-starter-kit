<?php

namespace App\Components;

use Filament\Forms;
use Filament\Forms\Get;
use FilamentAddons\Forms as AddonForms;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use FilamentTiptapEditor\TiptapEditor;

class Hero
{
    public static function make(): Forms\Components\Section
    {
        return Forms\Components\Section::make()
            ->schema([
                Forms\Components\Radio::make('hero.type')
                    ->inline()
                    ->default('image')
                    ->options([
                        'image' => 'Image',
                        'oembed' => 'oEmbed',
                        'slider' => 'Slider',
                    ])
                    ->reactive(),
                AddonForms\Components\OEmbed::make('hero.oembed')
                    ->label('Details (If Image is selected video will be in popup)')
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'oembed' ?: false),
                CuratorPicker::make('hero.image')
                    ->label('Image')
                    ->lazyLoad()
                    ->listDisplay()
                    ->constrained(true)
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'image' ?: false),
                TiptapEditor::make('hero.cta')
                    ->visible(fn (Get $get): bool => $get('hero.type') != 'slider' ?: false)
                    ->label('Call to Action'),
                Forms\Components\Repeater::make('hero.sliders')
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'slider' ?: false)
                    ->label('Sliders')
                    ->schema([
                        CuratorPicker::make('image')
                            ->label('Image')
                            ->lazyLoad()
                            ->listDisplay()
                            ->constrained(true)
                            ->visible(),
                        Forms\Components\TextInput::make('text_1'),
                        Forms\Components\TextInput::make('text_2'),
                        Forms\Components\TextInput::make('text_3'),
                        Forms\Components\TextInput::make('button_text'),
                        Forms\Components\TextInput::make('button_url'),
                    ])->cloneable()
                    ->columns(3),
            ]);
    }
}
