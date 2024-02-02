<x-layouts.base :meta="$page->meta">
    @section('hero')
        <x-hero :data="$page->hero" />
    @endsection

    @if ($page->content)
        <x-page-builder :content="$page->content" />
    @endif
</x-layouts.base>
