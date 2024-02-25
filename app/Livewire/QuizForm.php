<?php

namespace App\Livewire;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Get;
use Livewire\Component;
use App\Models\QuizUser;
use Filament\Forms\Form;
use App\Models\QuizTopic;
use App\Models\QuizResult;
use App\Models\QuizQuestion;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class QuizForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $quizUserData = [
        'name' => null,
        'email' => null,
        'age' => null,
        'self_or_else' => false,
        'person_name' => null,
        'person_father_name' => null,
        'person_contact_no' => null,
        'person_age' => null,
        'location' => null,
        'gender' => null,
    ];

    public $topic;

    public $age;
    public $quizUserId;
    public $count;
    public $quizSize;
    public $currentQuestion;
    public $currentQuizAnswers;
    public $quizPercentage;
    public $totalQuizQuestions;
    public $currentResultData;
    public $answeredQuestionsWithOptions;

    // Custom Values
    public $quizRegister = false; // Progress
    public $quizContent = true; // Progress
    public $quizInProgress = false; // Progress
    public $showResult = false; // Progress
    public $isDisabled = true; // Button
    public $userAnswered; // Checkbox
    public $answeredQuestions = []; // Answered Question List

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required(),
                Forms\Components\TextInput::make('age')
                    ->numeric()
                    ->required(),
                Forms\Components\Toggle::make('self_or_else')
                    ->label('Do you want to Enroll Yourself or Someone else in Class?')
                    ->reactive()
                    ->required(),
                Forms\Components\TextInput::make('person_name')
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else')),
                Forms\Components\TextInput::make('person_father_name')
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else')),
                Forms\Components\TextInput::make('person_contact_no')
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else')),
                Forms\Components\TextInput::make('person_age')
                    ->numeric()
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else')),
                Forms\Components\TextInput::make('location')
                    ->label('Locality Where You Stay')
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else')),
                Forms\Components\Select::make('gender')
                    ->visible(fn (Get $get): bool => $get('self_or_else'))
                    ->required(fn (Get $get): bool => $get('self_or_else'))
                    ->options([
                        'Male' => 'Male',
                        'Female' => 'Female',
                    ]),
            ])->statePath('quizUserData');
    }

    public function registerQuizUser()
    {
        $this->age = $this->quizUserData['age'];
        $new_dob = new Carbon();
        $this->quizUserData['dob'] = $new_dob->subYears($this->age)->format('Y-m-d');

        unset($this->quizUserData['age']);

        if (!is_null($this->quizUserData['person_age'])) {
            $this->quizUserData['person_dob'] = $new_dob->subYears($this->quizUserData['person_age'])->format('Y-m-d');
        }
        unset($this->quizUserData['person_age']);

        $quizUser = QuizUser::create($this->quizUserData);
        $this->quizUserId = $quizUser->id;

        if (!is_null($this->topic->content)) {
            $this->quizContent = true;
            $this->quizRegister = false;
        } else {
            $this->quizRegister = false;
            $this->startQuiz();
        }
    }

    public function startQuiz()
    {
        if ($this->topic->type == 'Marks') {
            $this->quizRegister = false;
        } else {
            $this->quizContent = false;
            $this->quizRegister = false;

            $topicData = QuizTopic::where('id', $this->topic->id)->get();

            if ($this->age == 0 && $this->topic->is_age_restricted) {
                $topicData->transform(function ($category) {
                    $category->questions = QuizQuestion::whereHas('quizTopic', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();

                    return $category;
                });
            } elseif ($this->age > 12 && $this->topic->is_age_restricted) {
                $topicData->transform(function ($category) {
                    $category->questions = QuizQuestion::whereHas('quizTopic', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->where('age_restriction_condition', '=', '>=12')
                        ->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();

                    return $category;
                });
            } elseif ($this->age <= 12 && $this->topic->is_age_restricted) {
                $topicData->transform(function ($category) {
                    $category->questions = QuizQuestion::whereHas('quizTopic', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->where('age_restriction_condition', '=', '<=12')
                        ->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();

                    return $category;
                });
            } else {
                $topicData->transform(function ($category) {
                    $category->questions = QuizQuestion::whereHas('quizTopic', function ($q) use ($category) {
                        $q->where('id', $category->id);
                    })->inRandomOrder()
                        ->take($category->count ?? 5)
                        ->get();

                    return $category;
                });
            }

            $this->quizSize = $topicData->first()->questions->count();

            $this->count = 1;
            $this->currentQuestion = $this->getNextQuestion();

            $this->quizInProgress = true;
        }
    }

    public function updatedUserAnswered() // User Answers
    {
        if (empty($this->userAnswered)) {
            $this->isDisabled = true;
        } else {
            $this->isDisabled = false;
        }
    }

    public function getNextQuestion() // Next Question
    {
        if ($this->age == 0 && $this->topic->is_age_restricted) {
            $question = QuizQuestion::where('quiz_topic_id', $this->topic->id)
                ->with('quizOptions')
                ->whereNotIn('id', $this->answeredQuestions)
                ->inRandomOrder()
                ->first();
        } elseif ($this->age > 12 && $this->topic->is_age_restricted) {
            $question = QuizQuestion::where('quiz_topic_id', $this->topic->id)
                ->with('quizOptions')
                ->whereNotIn('id', $this->answeredQuestions)
                ->where('age_restriction_condition', '=', '>=12')
                ->inRandomOrder()
                ->first();
        } elseif ($this->age <= 12 && $this->topic->is_age_restricted) {
            $question = QuizQuestion::where('quiz_topic_id', $this->topic->id)
                ->with('quizOptions')
                ->whereNotIn('id', $this->answeredQuestions)
                ->where('age_restriction_condition', '=', '<=12')
                ->inRandomOrder()
                ->first();
        } else {
            $question = QuizQuestion::where('quiz_topic_id', $this->topic->id)
                ->with('quizOptions')
                ->whereNotIn('id', $this->answeredQuestions)
                ->inRandomOrder()
                ->first();
        }

        if ($this->count < $this->quizSize) {
            array_push($this->answeredQuestions, $question->id);
        }

        return $question;
    }

    public function nextQuestion() // Adding to Result
    {
        [$answerId, $isChoiceCorrect] = explode(',', $this->userAnswered);

        QuizResult::create([
            'quiz_user_id' => $this->quizUserId,
            'quiz_topic_id' => $this->currentQuestion->quiz_topic_id,
            'quiz_question_id' => $this->currentQuestion->id,
            'quiz_option_id' => $answerId,
            'correct' => (int)$isChoiceCorrect ?? 0,
        ]);

        $this->count++;

        $answerId = '';
        $isChoiceCorrect = '';
        $this->reset('userAnswered');
        $this->isDisabled = true;

        if ($this->count == $this->quizSize + 1) {
            if (!is_null($this->topic->declaration)) {
                $this->quizInProgress = false;
            } else {
                $this->showResults();
            }
        }

        $this->currentQuestion = $this->getNextQuestion();
    }

    public function showResults() // Show Results
    {
        // Get a count of total number of quiz questions in Quiz table for the just finished quiz.
        $this->totalQuizQuestions = QuizResult::where('quiz_topic_id', $this->topic->id)->where('quiz_user_id', $this->quizUserId)->count();
        // Get a count of correctly answered questions for this quiz.
        $this->currentQuizAnswers = QuizResult::where('quiz_topic_id', $this->topic->id)
            ->where('correct', 1)
            ->where('quiz_user_id', $this->quizUserId)
            ->count();
        // Calculate score for updating the quiz_header table before finishing the quid.
        $this->quizPercentage = round(($this->currentQuizAnswers / $this->totalQuizQuestions) * 100, 2);
        // Hide quiz div and show result div wrapped in if statements in the blade template.
        $this->quizInProgress = false;
        $this->showResult = true;

        // Gets All Question Id's User Attended
        $this->currentResultData = QuizResult::where('quiz_user_id', $this->quizUserId)->get();
        // dd($answeredQuestionIds);
        $this->answeredQuestionsWithOptions = QuizQuestion::whereIn('id', $this->currentResultData->pluck('quiz_question_id'))->with('quizOptions')->get();
    }

    public function render()
    {
        return view('livewire.quiz-form');
    }
}
