<x-layouts.base :meta="$meta">

    @section('hero')
        <x-hero :media="$article->featuredImage" />
    @endsection

    <x-grid>
        <div class="pt-8 lg:t-12">
            <x-widget :data="['level' => 'h1', 'content' => $article->title]" />

            <div class="flex items-center justify-between py-2 mt-2 border-t border-b">
                @if ($article->tags)
                    <p class="font-bold">Tagged: {{ $article->tags->implode('name', ', ') }}</p>
                @endif
                <p class="font-bold">Published: <time
                        datetime="{{ $article->published_at }}">{{ $article->published_at->diffForHumans() }}</time>
                </p>
            </div>
        </div>

        @if ($article->content)
            <x-page-builder :content="$article->content" />
        @endif
        {{--
        <x-slot name="sidebar">
            <x-widgets.discovery-center />
        </x-slot> --}}
    </x-grid>

</x-layouts.base>
