<a href="{{ $route }}"
    class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-white/10 dark:bg-gray-900 dark:hover:bg-gray-700">
    <x-curator-glider :class="implode(' ', [
        'object-cover',
        'w-full',
        'h-96',
        'md:h-auto',
        'md:w-48',
        'aspect-square',
        $imageLocation == 'left' ? 'order-last' : null,
        $imageLocation == 'left' ? 'rounded-r-lg' : 'rounded-l-lg',
    ])" :media="$imageId" :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-2">
            {{ $title }}
        </h5>
        <x-prose>
            {!! $content !!}
        </x-prose>
    </div>
</a>
