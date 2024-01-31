<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Menu;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\MenuResource\Pages;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\MenuResource\RelationManagers;
use Filament\Resources\Concerns\Translatable;

class MenuResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = Menu::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static ?string $navigationGroup = 'CMS';

    public static function form(Form $form): Form
    {
        $routeList = [];
        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $key => $route) {
            if (isset($route->action['as'])) {
                $routeList[$route->action['as']] = $route->uri;
            } else {
                array_push($routeList, $route->uri);
            }
        }

        return $form
            ->schema([
                Forms\Components\Section::make()->schema([
                    Forms\Components\Group::make()->schema([
                        Forms\Components\TextInput::make('title')
                            ->required(),
                        Forms\Components\TextInput::make('key')
                            ->required(),
                        Forms\Components\TextInput::make('location')
                            ->required()
                            ->default('header'),
                        Forms\Components\Toggle::make('activated')
                            ->required(),
                    ]),
                    Forms\Components\Group::make()->schema([
                        Forms\Components\Repeater::make('items')->schema([
                            Forms\Components\TextInput::make('title')
                                ->label(__('Item Title'))
                                ->required(),
                            Forms\Components\TextInput::make('url')
                                ->label(__('Item URL'))
                                ->required(),
                            Forms\Components\Select::make('route')
                                ->label(__('Item Route'))
                                ->searchable()
                                ->options($routeList),
                            IconPicker::make('icon')
                                ->required()
                                ->hint('icon must start with [heroicon]'),
                            Forms\Components\Toggle::make('blank')
                                ->label("Open on new window")
                                ->required(),
                        ])->columns(2),
                    ]),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('title')
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
