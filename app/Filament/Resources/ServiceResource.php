<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Service;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Components\Meta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use FilamentAddons\Enums\Status;
use Livewire\Attributes\Reactive;
use App\Forms\Components\PageBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Guava\FilamentIconPicker\Forms\IconPicker;
use App\Filament\Resources\ServiceResource\Pages;
use FilamentAddons\Forms\Components\TitleWithSlug;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;
use App\Filament\Resources\ServiceResource\RelationManagers;

class ServiceResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Content';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make()->schema([
                    Forms\Components\Tabs\Tab::make(__('Title & Details'))->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (Get $get, Set $set, ?string $operation, ?string $old, ?string $state) {
                                if ($operation == 'edit') {
                                    return;
                                }
                                if (($get('slug') ?? '') !== Str::slug($old)) {
                                    return;
                                }
                                $set('slug', Str::slug($state));
                            }),
                        Forms\Components\TextInput::make('slug')
                            ->unique(Service::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation) => $operation == 'edit')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Textarea::make('excerpt')
                            ->required()
                            ->maxLength(255),
                        IconPicker::make('icon')
                            ->sets(['remix'])
                            ->columns([
                                'default' => 1,
                                'lg' => 3,
                                '2xl' => 5,
                            ]),
                        CuratorPicker::make('image_id')
                            ->label('Image')
                            ->lazyLoad()
                            ->listDisplay()
                            ->constrained(true)
                            ->visible(),
                        Forms\Components\Select::make('status')
                            ->default('Draft')
                            ->options(Status::class)
                            ->required(),
                        Flatpickr::make('published_at')
                            ->label('Publish Date'),
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
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\TextColumn::make('icon')
                    ->searchable(),
                CuratorColumn::make('image')
                    ->size(40),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('published_at')
                    ->date()
                    ->sortable(),
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
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\ForceDeleteAction::make(),
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'view' => Pages\ViewService::route('/{record}'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
