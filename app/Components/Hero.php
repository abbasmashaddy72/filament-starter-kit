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
                    ])
                    ->reactive(),
                AddonForms\Components\OEmbed::make('hero.oembed')
                    ->label('Details (If Image is selected video will be in popup)')
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'oembed' ?: false),
                CuratorPicker::make('hero.image')
                    ->label('Image')
                    ->visible(),
                TiptapEditor::make('hero.cta')
                    ->label('Call to Action'),
            ]);
    }
}
