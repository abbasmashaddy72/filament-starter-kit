<?php

namespace App\Components;

use Closure;
use Filament\Forms;
use Filament\Forms\Get;
use FilamentAddons\Forms as AddonForms;
use FilamentCurator\Forms as CuratorForms;
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
                CuratorPicker::make('hero.image')
                    ->label('Image')
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'image' ?: false),
                AddonForms\Components\OEmbed::make('hero.oembed')
                    ->label('Details')
                    ->visible(fn (Get $get): bool => $get('hero.type') == 'oembed' ?: false),
                TiptapEditor::make('hero.cta')
                    ->label('Call to Action'),
            ]);
    }
}
