<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\QuizUser;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use App\Filament\Resources\QuizUserResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\QuizUserResource\RelationManagers;

class QuizUserResource extends Resource
{
    protected static ?string $model = QuizUser::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Quiz';

    public static function shouldRegisterNavigation(): bool
    {
        return  config('main.menu.resources.quiz-user');
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('unique_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Toggle::make('self_or_else')
                    ->required(),
                Forms\Components\TextInput::make('person_father_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('person_name')
                    ->maxLength(255),
                Forms\Components\TextInput::make('person_contact_no')
                    ->maxLength(255),
                Forms\Components\DatePicker::make('dob'),
                Forms\Components\TextInput::make('location')
                    ->maxLength(255),
                Forms\Components\TextInput::make('gender')
                    ->required()
                    ->maxLength(255)
                    ->default('Male'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unique_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('self_or_else')
                    ->boolean(),
                Tables\Columns\TextColumn::make('person_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('person_contact_no')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dob')
                    ->date()
                    ->formatStateUsing(fn ($state) => now()->diff($state)->format('%y years') . ' | ' . $state->format('M d, Y'))
                    ->sortable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->searchable(),
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
            QuizUserResource\RelationManagers\QuizResultsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizUsers::route('/'),
            'create' => Pages\CreateQuizUser::route('/create'),
            'view' => Pages\ViewQuizUser::route('/{record}'),
            'edit' => Pages\EditQuizUser::route('/{record}/edit'),
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
