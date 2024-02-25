<x-filament::section class="w-full  {{ isset($quizContent) && $quizContent ? '' : 'max-w-[400px]' }} m-auto">
    @if (!$quizContent)
        <x-slot name="heading">
            {{ $topic->meta->title }}
        </x-slot>
    @endif

    @if ($quizRegister)
        {{ $this->form }}
        <div class="flex justify-end">
            <x-filament::button wire:click="registerQuizUser" class="mt-4">
                @if (!isset($topic->content))
                    Start Quiz
                @else
                    Register
                @endif
            </x-filament::button>
        </div>
    @endif

    @if ($quizContent)
        <x-page-builder :content="$topic->content" />
        <div class="flex justify-center">
            <x-filament::button wire:click="startQuiz" class="mt-4">
                Start Quiz
            </x-filament::button>
        </div>
    @endif

    @if ($quizInProgress)
        <div class="flex justify-end max-w-auto">
            <p class="max-w-2xl mt-1 text-sm">
                <span class="p-1 font-extrabold">Quiz Progress</span>
                <span
                    class="p-3 font-bold leading-loose text-white rounded-full bg-primary-600 dark:bg-gray-800">{{ $count . '/' . $quizSize }}</span>
            </p>
        </div>
        <form wire:submit.prevent>
            <div class="mt-4">
                <h3 class="mb-2 text-base font-semibold leading-6">
                    {{ $currentQuestion->question_text }}
                </h3>
                @foreach ($currentQuestion->quizOptions as $answer)
                    <label for="question-{{ $answer->id }}">
                        <div
                            class="px-3 py-3 m-3 text-sm border-2 border-gray-300 rounded-lg max-w-auto dark:border-gray-700">
                            <label class="inline-flex items-center">
                                <input type="radio" class="w-4 h-4 form-radio" id="question-{{ $answer->id }}"
                                    value="{{ $answer->id . ',' . $answer->is_correct }}"
                                    wire:model.live="userAnswered">
                                <span class="ml-2">{{ $answer->option_text }}</span>
                            </label>
                        </div>
                    </label>
                @endforeach
            </div>
            <div class="flex items-center justify-end mt-4">
                @if ($count < $quizSize)
                    <button wire:click="nextQuestion" type="submit"
                        @if ($isDisabled) disabled='disabled' @endif
                        class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition border border-transparent rounded-md bg-primary-600 hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25">
                        {{ __('Next Question') }}
                    </button>
                @else
                    <button wire:click="nextQuestion" type="submit"
                        @if ($isDisabled) disabled='disabled' @endif
                        class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition border border-transparent rounded-md bg-primary-600 hover:bg-primary-700 active:bg-primary-900 focus:outline-none focus:border-primary-900 focus:ring focus:ring-primary-300 disabled:opacity-25">
                        {{ __('Show Results') }}
                    </button>
                @endif
            </div>
        </form>
    @endif

    @if ($showResult)
        <div class="justify-center mb-5 text-center">
            <h1 class="mb-4 text-2xl font-medium text-center text-gray-900 dark:text-white sm:text-3xl title-font">
                Quiz Result
            </h1>

            <p class="mt-10 text-gray-500 text-md dark:text-gray-400">
                Dear <span class="mr-2 font-extrabold text-primary-600">
                    {{ $quizUserData['name'] . '!' }}
                </span>You have secured
            </p>

            <progress class="mx-auto text-base leading-relaxed xl:w-2/4 lg:w-3/4" value="{{ $quizPercentage }}"
                max="100">
                {{ $quizPercentage }}
            </progress>
            <span class="text-gray-500 dark:text-gray-400">{{ $quizPercentage }}%</span>
        </div>
        <div class="grid grid-cols-1 gap-2">
            <div class="flex items-center h-full p-4 bg-gray-100 rounded dark:bg-gray-800">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-success-500" viewBox="0 0 24 24">
                    <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                    <path d="M22 4L12 14.01l-3-3"></path>
                </svg>
                <span class="mr-5 font-medium text-primary-600 title-font">Correct
                    Answers</span><span class="font-medium title-font">{{ $currentQuizAnswers }}</span>
            </div>
            <div class="flex items-center h-full p-4 bg-gray-100 rounded dark:bg-gray-800">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-danger-500" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12">
                    </line>
                    <line x1="12" y1="16" x2="12.01" y2="16">
                    </line>
                </svg>
                <span class="mr-5 font-medium text-primary-600 title-font">Wrong
                    Answers</span><span
                    class="font-medium title-font">{{ $totalQuizQuestions - $currentQuizAnswers }}</span>
            </div>
            <div class="flex items-center h-full p-4 bg-gray-100 rounded dark:bg-gray-800">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"
                    stroke-linejoin="round" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17">
                    </line>
                </svg>
                <span class="mr-5 font-medium text-primary-600 title-font">Total
                    Questions</span><span class="font-medium title-font">{{ $totalQuizQuestions }}</span>
            </div>
        </div>

        @foreach ($answeredQuestionsWithOptions as $item)
            <div class="mt-4">
                <h3 class="mb-2 text-base font-semibold leading-6">
                    <span class="mr-2 font-extrabold"> {{ $loop->iteration }}.</span>
                    {{ $item->question_text }}
                </h3>
                @php
                    $questionId = $item->id;
                    $selectedOptionId = $currentResultData->where('quiz_question_id', $questionId)->pluck('quiz_option_id')->first();
                @endphp

                @foreach ($item->quizOptions as $answer)
                    @php
                        $isCorrect = $answer->is_correct;
                        $isSelected = $selectedOptionId == $answer->id;
                    @endphp
                    <label for="question-{{ $answer->id }}">
                        <div
                            class="px-3 py-3 m-3 text-sm border-2 border-gray-300 rounded-lg max-w-auto dark:border-gray-700
                            @if ($isCorrect && !$isSelected) bg-success-500
                            @elseif (!$isCorrect && $isSelected) bg-danger-500 @endif">
                            <label class="inline-flex items-center">
                                <input type="radio" class="w-4 h-4 form-radio" id="question-{{ $answer->id }}"
                                    value="{{ $answer->id . ',' . $answer->is_correct }}"
                                    @if ($isSelected) checked @endif disabled>
                                <span class="ml-2">{{ $answer->option_text }}</span>
                            </label>
                        </div>
                    </label>
                @endforeach
            </div>
        @endforeach

        <div class="flex flex-wrap justify-center mt-4">
            {{ __('Thanks for attempting the Quiz, Please Collect Your Gift.') }}
        </div>
    @endif
    @if ($preRegister)
        You Have Registered Your Self For Children's Exhibition.<br> Collect Your Gift At Registration
        Counter On Exhibition Day.
    @endif
</x-filament::section>
