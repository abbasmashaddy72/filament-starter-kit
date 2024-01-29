@props([
    'content' => null,
])

<div class="p-6 space-y-6 bg-gray-800 border border-black shadow-sm rounded-xl">
    @if ($content)
        <h3 class="text-xl font-bold tracking-tight">
            {{ $content }}
        </h3>
    @endif

    <div>
        {{ $slot }}
    </div>
</div>
