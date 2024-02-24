<?php

namespace App\Filament\Resources\QuizTopicResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Livewire\Attributes\Reactive;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class QuizQuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'quizQuestions';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('age_restriction_condition')
                    ->default(0)
                    ->helperText('Input Type: <=12 | >=12')
                    ->required(),
                Forms\Components\TextInput::make('more_info_link')
                    ->maxLength(255),
                Forms\Components\TextInput::make('question_text')
                    ->required(),
                Forms\Components\Textarea::make('answer_explanation')
                    ->rows(6),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('quizTopic.quiz_topic_id')
            ->columns([
                Tables\Columns\TextColumn::make('question_text'),
                Tables\Columns\TextColumn::make('answer_explanation'),
                Tables\Columns\TextColumn::make('more_info_link'),
                Tables\Columns\TextColumn::make('age_restriction_condition'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
