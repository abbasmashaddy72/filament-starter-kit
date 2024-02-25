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
            @livewire('quiz-form', ['topic' => $page])
        @else
            @if ($page->content)
                <x-page-builder :content="$page->content" />
            @endif
        @endif
    </div>
</x-layouts.base>
