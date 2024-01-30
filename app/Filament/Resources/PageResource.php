<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Page;
use Filament\Tables;
use FilamentAddons\Enums\Status;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Components\Hero;
use App\Components\Meta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use App\Forms\Components\PageBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PageResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PageResource\RelationManagers;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make(__('Title & Details'))->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->live()
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {
                                if ($operation == 'edit') {
                                    return;
                                }
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            })
                            ->maxLength(255),
                        Forms\Components\TextInput::make('slug')
                            ->required()
                            ->unique(Page::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation) => $operation == 'edit')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->disabled(fn ($get) => $get('front_page') ?: false)
                            ->default('Draft')
                            ->options(Status::class)
                            ->required(),
                        Forms\Components\Select::make('layout')
                            ->disabled(fn ($get) => $get('front_page') ?: false)
                            ->default('default')
                            ->options([
                                'default' => 'Default',
                                'full' => 'Full Width',
                            ])
                            ->required(),
                        Forms\Components\Toggle::make('front_page')
                            ->inline(false)
                            ->disabled(fn (?Model $record) => $record ? $record->front_page : false)
                            ->reactive(),
                    ]),
                    Forms\Components\Tabs\Tab::make('Hero')
                        ->schema([
                            Hero::make('hero'),
                        ]),
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            Meta::make(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Page Content')
                        ->schema([
                            PageBuilder::make('content'),
                        ]),
                ])->columns(2)->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('layout')
                    ->searchable(),
                Tables\Columns\IconColumn::make('front_page')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
