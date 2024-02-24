<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Enums\Status;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Components\Hero;
use App\Components\Meta;
use Filament\Forms\Form;
use App\Models\QuizTopic;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use LaraZeus\Qr\Facades\Qr;
use App\Enums\QuizTopicStatus;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
use App\Forms\Components\PageBuilder;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\QuizTopicResource\Pages;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuizTopicResource\RelationManagers;

class QuizTopicResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = QuizTopic::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Quiz';

    public static function shouldRegisterNavigation(): bool
    {
        return  config('main.menu.resources.quiz-topic');
    }

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
                            ->unique(QuizTopic::class, 'slug', fn ($record) => $record)
                            ->disabled(fn (?string $operation) => $operation == 'edit')
                            ->maxLength(255),
                        Forms\Components\Select::make('type')
                            ->native(false)
                            ->required()
                            ->options(QuizTopicStatus::class),
                        Forms\Components\Select::make('status')
                            ->default('Draft')
                            ->options(Status::class)
                            ->required(),
                        Forms\Components\DatePicker::make('start'),
                        Forms\Components\DatePicker::make('end'),
                        Forms\Components\Toggle::make('is_age_restricted')
                            ->required(),
                        Forms\Components\TextInput::make('total_question_count')
                            ->numeric(),
                        Forms\Components\Textarea::make('excerpt'),
                    ]),
                    Forms\Components\Tabs\Tab::make('SEO')
                        ->schema([
                            Meta::make(),
                        ]),
                    Forms\Components\Tabs\Tab::make('Hero')
                        ->schema([
                            Hero::make('hero'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Page Content')
                        ->schema([
                            PageBuilder::make('content'),
                        ]),
                    Forms\Components\Tabs\Tab::make('Attachments')
                        ->schema([
                            CuratorPicker::make('medias')
                                ->hiddenLabel()
                                ->relationship('medias', 'id')
                                ->helperText(__('Here you can attach all files needed for this ticket'))
                                ->multiple()
                                ->listDisplay(),
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
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end')
                    ->date()
                    ->sortable(),
                Tables\Columns\IconColumn::make('age_restriction')
                    ->boolean(),
                Tables\Columns\TextColumn::make('total_question_count')
                    ->numeric()
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
                \LaraZeus\Popover\Tables\PopoverColumn::make('title')
                    ->trigger('click')
                    ->placement('right')
                    ->offset(10)
                    ->popOverMaxWidth('none')
                    ->icon('heroicon-o-chevron-right')
                    ->content(fn ($record) => (new static())->generateQR($record)),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            RelationManagers\QuizQuestionsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizTopics::route('/'),
            'create' => Pages\CreateQuizTopic::route('/create'),
            'view' => Pages\ViewQuizTopic::route('/{record}'),
            'edit' => Pages\EditQuizTopic::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function generateQR($record)
    {
        $url = route('quiztopic.show', ['page' => $record->slug]);

        $data = Qr::render(data: $url);

        return $data;
    }
}
