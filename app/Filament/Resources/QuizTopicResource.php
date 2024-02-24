<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\QuizTopic;
use Filament\Tables\Table;
use App\Enums\QuizTopicStatus;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
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
                Forms\Components\Select::make('type')
                    ->native(false)
                    ->required()
                    ->options(QuizTopicStatus::class),
                Forms\Components\TextInput::make('title')
                    ->required(),
                Forms\Components\DatePicker::make('start'),
                Forms\Components\DatePicker::make('end'),
                Forms\Components\Toggle::make('is_age_restricted')
                    ->required(),
                Forms\Components\TextInput::make('total_question_count')
                    ->numeric(),
                Forms\Components\RichEditor::make('description')
                    ->columnSpanFull(),
                Forms\Components\Fieldset::make('Attachments')->schema([
                    CuratorPicker::make('medias')
                        ->hiddenLabel()
                        ->relationship('medias', 'id')
                        ->helperText(__('Here you can attach all files needed for this ticket'))
                        ->multiple()
                        ->listDisplay(),
                ]),
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
}
