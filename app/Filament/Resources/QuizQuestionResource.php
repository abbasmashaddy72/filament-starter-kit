<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\QuizQuestion;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuizQuestionResource\Pages;

class QuizQuestionResource extends Resource
{
    use Translatable;

    #[Reactive]
    public ?string $activeLocale = null;

    protected static ?string $model = QuizQuestion::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Quiz';

    public static function shouldRegisterNavigation(): bool
    {
        return  config('main.menu.resources.quiz-question');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('quiz_topic_id')
                        ->relationship('quizTopic', fn (Component $livewire): string => 'title->' . $livewire->activeLocale)
                        ->searchable()
                        ->preload()
                        ->live()
                        ->required(),
                    Forms\Components\TextInput::make('age_restriction_condition')
                        ->default(0)
                        ->helperText('Input Type: <=12 | >=12')
                        ->required(),
                    Forms\Components\TextInput::make('more_info_link')
                        ->maxLength(255),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\TextInput::make('question_text')
                        ->required(),
                    Forms\Components\Textarea::make('answer_explanation')
                        ->rows(6),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Repeater::make('quizOptions')->relationship()
                        ->schema([
                            Forms\Components\TextInput::make('option_text')
                                ->required(),
                            Forms\Components\Toggle::make('is_correct')
                                ->default(false)
                                ->fixIndistinctState()
                                ->required(),
                        ])->grid([
                            'default' => 1,
                            'md' => 2,
                            'xl' => 4,
                            '2xl' => 4,
                        ])->defaultItems(4)->maxItems(4)->minItems(2)
                ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quizTopic.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('question_text')
                    ->sortable(),
                Tables\Columns\TextColumn::make('answer_explanation')
                    ->sortable(),
                Tables\Columns\TextColumn::make('more_info_link')
                    ->searchable(),
                Tables\Columns\TextColumn::make('age_restriction_condition'),
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
            'index' => Pages\ListQuizQuestions::route('/'),
            'create' => Pages\CreateQuizQuestion::route('/create'),
            'view' => Pages\ViewQuizQuestion::route('/{record}'),
            'edit' => Pages\EditQuizQuestion::route('/{record}/edit'),
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
