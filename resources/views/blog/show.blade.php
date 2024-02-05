<x-layouts.base :meta="$meta">
    @section('hero')
        <x-hero :media="$post->featuredImage" />
    @endsection

    <x-grid>
        <div class="pt-8 lg:t-12">
            <x-widget :data="['level' => 'h1', 'content' => $post->title]" />

            <div class="flex items-center justify-between py-2 mt-2 border-t border-b">
                @if ($post->tags)
                    <p class="font-bold">Tagged: {{ $post->tags->implode('name', ', ') }}</p>
                @endif
                <p class="font-bold">Published: <time
                        datetime="{{ $post->published_at }}">{{ $post->published_at->diffForHumans() }}</time></p>
            </div>
        </div>

        @if ($post->content)
            <x-page-builder :content="$post->content" />
        @endif

        {{-- <x-slot name="sidebar">
            <x-widgets.discovery-center />
        </x-slot> --}}

    </x-grid>
</x-layouts.base>
