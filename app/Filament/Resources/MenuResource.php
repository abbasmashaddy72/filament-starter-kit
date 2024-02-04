<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use App\Models\Page;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\MenuResource\Pages;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MenuResource\RelationManagers;

class MenuResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationGroup = 'CMS';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        $configMenu = config('main.menu');
        $databaseOptions = Page::where('status', 'Published')->where('front_page', false)->pluck('title', 'slug')->toArray();
        $URLoptionsKeys = array_keys($configMenu + $databaseOptions);
        $URLoptionsValues = array_values($configMenu + $databaseOptions);

        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Select::make('location')
                            ->options([
                                'header' => 'Header',
                                'footer1' => 'Footer 1',
                                'footer2' => 'Footer 2',
                                'headerButtons' => 'Header Button',
                            ])
                            ->required()
                            ->default('header'),
                        Forms\Components\Toggle::make('activated')
                            ->required(),
                    ])->columns(2),
                    Forms\Components\Group::make()
                        ->schema([
                            Forms\Components\Section::make('Items')
                                ->description('For external links, include "https://". For internal links, provide the slug. Use "/" for the homepage.')
                                ->schema([
                                    Forms\Components\Repeater::make('items')
                                        ->label('')
                                        ->schema([
                                            Forms\Components\TextInput::make('title')
                                                ->label(__('Item Title'))
                                                ->dataList($URLoptionsValues)
                                                ->required(),
                                            Forms\Components\TextInput::make('url')
                                                ->label(__('Item URL'))
                                                ->dataList($URLoptionsKeys)
                                                ->required(),
                                            Forms\Components\Toggle::make('blank')
                                                ->label("Open on new window")
                                                ->required(),
                                        ])->grid([
                                            'default' => 1,
                                            'md' => 2,
                                            'xl' => 3,
                                            '2xl' => 3,
                                        ]),
                                ]),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('location')
                    ->badge()
                    ->searchable(),
                Tables\Columns\IconColumn::make('activated')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
