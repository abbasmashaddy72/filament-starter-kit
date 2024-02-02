<?php

namespace App\Forms\Components;

use Closure;
use Filament\Forms\Set;
use App\Forms\Blocks\Tabs;
use App\Forms\Blocks\Cards;
use App\Forms\Blocks\RichText;
use App\Forms\Blocks\Accordion;
use App\Forms\Blocks\ImageText;
use App\Forms\Blocks\OnlyImage;
use App\Forms\Blocks\SelectForm;
use App\Forms\Blocks\OtherSections;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Repeater;

class PageBuilder
{
    public static function make(string $field): Repeater
    {
        return Repeater::make($field)
            ->label('Sections')
            ->schema([
                Toggle::make('full_width')
                    ->default(false)
                    ->reactive()
                    ->afterStateUpdated(function (Set $set, $state) {
                        if ($state === false) {
                            return $set('bg_color', '');
                        }
                    }),
                Select::make('bg_color')
                    ->label('Background Color')
                    ->options([
                        'primary' => 'Primary',
                        'secondary' => 'Secondary',
                        'tertiary' => 'Tertiary',
                        'accent' => 'Accent',
                        'gray' => 'Gray',
                        'light-gray' => 'Light Gray',
                        'white' => 'White',
                        'half' => 'Half',
                    ]),
                Builder::make('blocks')
                    ->blocks([
                        RichText::make(),
                        Tabs::make(),
                        SelectForm::make(),
                        Accordion::make(),
                        Cards::make(),
                        ImageText::make(),
                        OnlyImage::make(),
                    ]),
            ])->columnSpanFull();
    }
}
