<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Topic;
use App\Models\Article;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Components\Meta;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use FilamentAddons\Enums\Status;
use Livewire\Attributes\Reactive;
use Illuminate\Support\Facades\Log;
use App\Forms\Components\PageBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\ArticleResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Coolsam\FilamentFlatpickr\Forms\Components\Flatpickr;

class ArticleResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = Article::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';

    protected static ?string $navigationGroup = 'Blog Management';

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
                            ->unique(Article::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation) => $operation == 'edit')
                            ->maxLength(255),
                        Forms\Components\Select::make('status')
                            ->default('Draft')
                            ->options(Status::class)
                            ->required(),
                        Flatpickr::make('published_at')
                            ->label('Publish Date'),
                        Forms\Components\Select::make('topic_id')
                            ->relationship('topic')
                            ->getOptionLabelFromRecordUsing(function (Topic $topic, $livewire) {
                                // Debugging statement
                                Log::info('Active Locale: ' . $livewire->activeLocale);

                                // Adjust according to your actual implementation
                                $translatedTitle = $topic->getTranslation('title', $livewire->activeLocale);

                                // Debugging statement
                                Log::info('Translated Title: ' . $translatedTitle);

                                return $translatedTitle ?? $topic->title; // Fallback to default title if translation is not available
                            })
                            ->searchable()
                            ->preload()
                            ->live(),
                        Forms\Components\Select::make('author_id')
                            ->relationship('author', 'name')
                            ->required(),
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
                Tables\Columns\TextColumn::make('topic_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('author_id')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListArticles::route('/'),
            'create' => Pages\CreateArticle::route('/create'),
            'view' => Pages\ViewArticle::route('/{record}'),
            'edit' => Pages\EditArticle::route('/{record}/edit'),
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
