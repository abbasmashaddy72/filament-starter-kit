<x-layouts.base :meta="$page->meta">
    @section('hero')
        <x-hero :data="$page->hero ?? [
            'type' => 'image',
            'image' => $page->meta->ogImage->id,
            'cta' => $page->title,
        ]" />
    @endsection

    <div class="py-8 pt-16 lg:py-12">
        @if (Route::currentRouteName() == 'quiztopic.show')
            @if ($page->content)
                <x-page-builder :content="$page->content" />
            @endif
            <div class="container mx-auto content">
                <a href="{{ route('quiz.start', ['page' => $page->slug]) }}"
                    class="flex items-center justify-center p-2 text-base font-normal tracking-wide text-center text-white align-middle transition duration-500 ease-in-out border rounded-md bg-primary-500 border-primary-500 hover:bg-primary-600 hover:border-primary-500">
                    Start Quiz
                </a>
            </div>
        @elseif(Route::currentRouteName() == 'quiz.start')
            @livewire('quiz-form', ['topic' => $page])
        @else
            @if ($page->content)
                <x-page-builder :content="$page->content" />
            @endif
        @endif
    </div>
</x-layouts.base>
