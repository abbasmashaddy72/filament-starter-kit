<a href="{{ $route }}"
    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 hover:bg-gray-100 dark:bg-gray-900 dark:border-white/10 dark:hover:bg-gray-700">

    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
        {{ $title }}
    </h5>
    <x-prose>
        {!! $content !!}
    </x-prose>
</a>
