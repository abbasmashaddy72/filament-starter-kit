<div
    class="w-full max-w-sm py-4 text-center transition duration-500 ease-in-out bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 group dark:bg-gray-900 dark:border-white/10">
    <div class="relative -m-3 text-transparent">
        <x-ri-hexagon-fill class='block mx-auto h-28 w-28 text-primary-400/15' />
        <x-dynamic-component :component="$icon"
            class="absolute flex items-center justify-center w-16 h-16 mx-auto align-middle transition duration-500 ease-in-out text-primary-400 top-2/4 -translate-y-2/4 start-0 end-0 rounded-xl" />
    </div>

    <div class="mt-6">
        <a href="{{ $route }}"
            class="text-lg transition duration-500 ease-in-out h5 hover:text-primary-400">{{ $title }}</a>
        <x-prose class="px-4 pt-2 line-clamp-4 text-slate-500 dark:text-slate-300">
            {!! $content !!}
        </x-prose>
    </div>
</div>
