<div id="custom-controls-gallery" class="relative flex flex-col items-center justify-center" data-carousel="static">
    <div class="relative overflow-hidden rounded-lg h-[80vh] aspect-[4/5]">
        @foreach ($data['image'] as $item)
            <div class="hidden duration-700 ease-in-out"
                data-carousel-item="@if ($loop->index == 0) active @endif">
                <x-curator-glider
                    class="absolute block -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 rounded-lg shadow-lg aspect-[4/5] object-cover"
                    :media="$item ?? app(\App\Settings\SitesSettings::class)->no_image" :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
            </div>
        @endforeach
    </div>
    <div class="flex items-center justify-center pt-4 ">
        <button type="button"
            class="flex items-center justify-center h-full cursor-pointer me-4 group focus:outline-none"
            data-carousel-prev>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5H1m0 0 4 4M1 5l4-4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="flex items-center justify-center h-full cursor-pointer group focus:outline-none"
            data-carousel-next>
            <span
                class="text-gray-400 hover:text-gray-900 dark:hover:text-white group-focus:text-gray-900 dark:group-focus:text-white">
                <svg class="w-5 h-5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 5h12m0 0L9 1m4 4L9 9" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>
