<div
    class="relative max-w-sm overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 dark:bg-gray-900 dark:border-white/10">
    @if (!empty($item->image->id))
        <a href="{{ $route }}">
            <x-curator-glider class="object-cover w-full rounded-t-lg aspect-video" :media="$item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image" :srcset="['1200w', '1024w', '640w']"
                sizes="(max-width: 1200px) 100vw, 1024px" />
        </a>
    @endif
    <div class="flex flex-col h-full p-5">
        <div>
            <a href="{{ $route }}">
                <h5 class="mb-2 text-lg font-medium tracking-tight text-gray-900 dark:text-white line-clamp-2">
                    {{ $item->title }}
                </h5>
            </a>
            @if(!empty($item->excerpt))
                <x-prose class="line-clamp-4 text-slate-500 dark:text-slate-300">
                    {{ $item->excerpt }}
                </x-prose>
            @endif
        </div>
        <div class="">
            <div class="text-slate-500 dark:text-slate-300">
                {{ $item->location }}
            </div>
            <div class="flex items-center justify-between mt-2 text-slate-500 dark:text-slate-300">
                <div>{{ \Carbon\Carbon::parse($item->start_date)->format('M Y') }}</div>
                @if(!empty($item->end_date))
                    <div>{{ \Carbon\Carbon::parse($item->end_date)->format('M Y') }}</div>
                @endif
            </div>
        </div>
        <div class="flex items-end justify-between @if ($route !== '#') mt-4 @endif">
            <span
                class="text-md absolute -right-11 top-6 w-40 rotate-45  @if (!empty($item->end_date)) bg-primary-500 @else bg-info-500 @endif text-center font-semibold text-white">
                {{ !empty($item->end_date) ? 'Completed' : 'OnGoing' }}
            </span>
            @if ($route !== '#')
                <a href="{{ $route }}"
                    class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-400 hover:bg-primary-500 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-400 dark:focus:ring-primary-500">
                    {{ $buttonText ?? 'Read More' }}
                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </a>
            @endif
        </div>
    </div>
</div>
