<x-layouts.base :meta="$page->meta">
    @section('hero')
        <x-hero :data="$page->hero ?? [
            'type' => 'image',
            'image' => $page->meta->ogImage->id,
            'cta' => $page->title,
        ]" />
    @endsection

    <div class="py-8 pt-16 lg:py-12">
        @if ($page->content)
            <x-page-builder :content="$page->content" />
        @endif
        {{-- <x-layouts.two-column-right>
            @if ($page->content)
                <x-page-builder :content="$page->content" />
            @endif

            <x-slot name="sidebar">
                <x-widget heading="Check out our awesome blog">
                    <p>When we get around to writing some posts.</p>
                </x-widget>
            </x-slot>

        </x-layouts.two-column-right> --}}
    </div>
</x-layouts.base>
