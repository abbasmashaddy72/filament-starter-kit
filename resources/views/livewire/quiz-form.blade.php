<x-filament::section class="w-full max-w-[400px] m-auto">
    <x-slot name="heading">
        {{ $topic->meta->title }}
    </x-slot>

    @if ($quizRegister)
        {{ $this->form }}
        <div class="flex justify-end">
            <x-filament::button wire:click="registerQuizUser" class="mt-4">
                Start Quiz
            </x-filament::button>
        </div>
    @endif

    @if ($quizInProgress)
        <div class="px-4 -py-3 sm:px-6 ">
            <div class="flex justify-end max-w-auto">
                <p class="max-w-2xl mt-1 text-sm text-gray-500">
                    <span class="p-1 font-extrabold text-gray-400 dark:text-white">Quiz Progress</span>
                    <span
                        class="p-3 font-bold leading-loose text-white bg-blue-500 rounded-full">{{ $count . '/' . $quizSize }}</span>
                </p>
            </div>
        </div>
        <form wire:submit.prevent class="mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900">
                    <span class="mr-2 font-extrabold"> {{ $count }}</span>
                    {{ $currentQuestion->question_text }}
                </h3>
                @foreach ($currentQuestion->quizOptions as $answer)
                    <label for="question-{{ $answer->id }}">
                        <div
                            class="px-3 py-3 m-3 text-sm text-gray-800 border-2 border-gray-300 rounded-lg max-w-auto ">
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
                        class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                        {{ __('Next Question') }}
                    </button>
                @else
                    <button wire:click="nextQuestion" type="submit"
                        @if ($isDisabled) disabled='disabled' @endif
                        class="inline-flex items-center px-4 py-2 m-4 text-xs font-semibold tracking-widest text-white uppercase transition bg-gray-800 border border-transparent rounded-md hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25">
                        {{ __('Show Results') }}
                    </button>
                @endif
            </div>
        </form>
    @endif

    @if ($showResult)
        <section class="text-gray-600 body-font">
            <div class="overflow-hidden bg-white border-2 border-gray-300 shadow sm:rounded-lg">
                <div class="container px-5 py-5 mx-auto">
                    <div class="justify-center mb-5 text-center">
                        <h1 class="mb-4 text-2xl font-medium text-center text-gray-900 sm:text-3xl title-font">
                            Quiz Result</h1>

                        <p class="mt-10 text-md"> Dear <span class="mr-2 font-extrabold text-blue-600">
                                {{ $name . '!' }} </span>You have secured</p>
                        <progress class="mx-auto text-base leading-relaxed xl:w-2/4 lg:w-3/4"
                            value="{{ $quizPercentage }}" max="100">
                            {{ $quizPercentage }} </progress> <span> {{ $quizPercentage }}% </span>
                    </div>
                    <div class="grid grid-cols-1 gap-2">
                        <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500" viewBox="0 0 24 24">
                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                <path d="M22 4L12 14.01l-3-3"></path>
                            </svg>
                            <span class="mr-5 font-medium text-purple-700 title-font">Correct
                                Answers</span><span class="font-medium title-font">{{ $currentQuizAnswers }},
                                (Green)</span>
                        </div>
                        <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="3" class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500" viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12">
                                </line>
                                <line x1="12" y1="16" x2="12.01" y2="16">
                                </line>
                            </svg>
                            <span class="mr-5 font-medium text-purple-700 title-font">Wrong
                                Answers</span><span
                                class="font-medium title-font">{{ $totalQuizQuestions - $currentQuizAnswers }},
                                (Red)</span>
                        </div>
                        <div class="flex items-center h-full p-4 bg-gray-100 rounded">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="flex-shrink-0 w-6 h-6 mr-4 text-indigo-500">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                                <line x1="12" y1="17" x2="12.01" y2="17">
                                </line>
                            </svg>
                            <span class="mr-5 font-medium text-purple-700 title-font">Total
                                Questions</span><span class="font-medium title-font">{{ $totalQuizQuestions }}</span>
                        </div>
                    </div>

                    @foreach ($answeredQuestionsWithOptions as $item)
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900">
                                <span class="mr-2 font-extrabold"> {{ $loop->iteration }}</span>
                                {{ $item->question_text }}
                            </h3>
                            @php
                                $data = $currentResultData->filter(function ($data) use ($item) {
                                    return stripos($data['question_id'], $item->id) !== false;
                                });

                            @endphp
                            @foreach ($item->quizOptions as $answer)
                                <label for="question-{{ $answer->id }}">
                                    <div
                                        class="px-3 py-3 m-3 text-sm text-gray-800 border-2 border-gray-300 rounded-lg max-w-auto @if ($answer->is_correct == 1) bg-green-600
                                        @elseif($data->first()->correct != 1 && $answer->id == $data->first()->option_id)
                                        bg-red-600
                                        @else @endif">
                                        <label class="inline-flex items-center">
                                            <input type="radio" class="w-4 h-4 form-radio"
                                                @if ($answer->is_correct == 1) checked @endif disabled
                                                id="question-{{ $answer->id }}"
                                                value="{{ $answer->id . ',' . $answer->is_correct }}">
                                            <span class="ml-2">{{ $answer->option_text }}</span>
                                        </label>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="flex flex-wrap justify-center">
                        {{ __('Thanks for attempting the Quiz, Please Collect Your Gift.') }}
                    </div>
                    @if (!is_null($topic->pdf))
                        <div class="flex justify-center mt-4 space-x-2">
                            <div>
                                <a href="{{ asset('storage/' . $topic->pdf) }}" download
                                    class="px-6 pt-2.5 pb-2 bg-blue-600 text-white font-medium text-xs leading-normal uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex align-center">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="download"
                                        class="w-3 mr-2" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 512 512">
                                        <path fill="currentColor"
                                            d="M216 0h80c13.3 0 24 10.7 24 24v168h87.7c17.8 0 26.7 21.5 14.1 34.1L269.7 378.3c-7.5 7.5-19.8 7.5-27.3 0L90.1 226.1c-12.6-12.6-3.7-34.1 14.1-34.1H192V24c0-13.3 10.7-24 24-24zm296 376v112c0 13.3-10.7 24-24 24H24c-13.3 0-24-10.7-24-24V376c0-13.3 10.7-24 24-24h146.7l49 49c20.1 20.1 52.5 20.1 72.6 0l49-49H488c13.3 0 24 10.7 24 24zm-124 88c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20zm64 0c0-11-9-20-20-20s-20 9-20 20 9 20 20 20 20-9 20-20z">
                                        </path>
                                    </svg>
                                    Download Free PDF!
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if ($preRegister)
        You Have Registered Your Self For Children's Exhibition.<br> Collect Your Gift At Registration
        Counter On Exhibition Day.
    @endif
</x-filament::section>

{{-- <div class="relative table w-full py-36 lg:py-44">
    <div class="container">
        <div class="flex justify-center">
            <div
                class="max-w-[400px] w-full m-auto p-4 bg-white dark:bg-slate-900 shadow-md dark:shadow-gray-800 rounded-md"> --}}
