<?php

namespace App\Forms\Components;

use App\Forms\Blocks\Tabs;
use App\Forms\Blocks\Cards;
use App\Forms\Blocks\RichText;
use App\Forms\Blocks\Accordion;
use App\Forms\Blocks\ImageText;
use App\Forms\Blocks\OnlyImage;
use App\Forms\Blocks\SelectForm;
use App\Forms\Blocks\ImageContent;
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
                Select::make('bg_color')
                    ->label('Background Color')
                    ->allowHtml()
                    ->searchable()
                    ->options(array_merge(['half' => 'Half'], getColors(200))),
                Toggle::make('combine')
                    ->helperText('Will only combine 2 Blocks'),
                Builder::make('blocks')
                    ->blocks([
                        RichText::make(),
                        Tabs::make(),
                        SelectForm::make(),
                        Accordion::make(),
                        Cards::make(),
                        ImageText::make(),
                        OnlyImage::make(),
                        ImageContent::make(),
                    ]),
            ])->columnSpanFull();
    }
}
