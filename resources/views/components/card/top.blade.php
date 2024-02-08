<div
    class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 dark:bg-gray-900 dark:border-white/10">
    <a href="{{ $route }}">
        <x-curator-glider class="object-cover w-full rounded-t-lg aspect-video" :media="$imageId" :srcset="['1200w', '1024w', '640w']"
            sizes="(max-width: 1200px) 100vw, 1024px" />
    </a>
    <div class="p-5">
        <a href="{{ $route }}">
            <h5 class="mb-2 text-lg font-medium tracking-tight text-gray-900 dark:text-white line-clamp-2">
                {{ $title }}</h5>
        </a>
        <x-prose class="line-clamp-4 text-slate-500 dark:text-slate-300">
            {!! $content !!}
        </x-prose>
        <a href="{{ $route }}"
            class="inline-flex items-center px-3 py-2 mt-3 text-sm font-medium text-center text-white rounded-lg bg-primary-400 hover:bg-primary-500 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-400 dark:focus:ring-primary-500">
            {{ $buttonText ?? 'Read More' }}
            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 14 10">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M1 5h12m0 0L9 1m4 4L9 9" />
            </svg>
        </a>
    </div>
</div>
