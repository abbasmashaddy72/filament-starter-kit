<div data-hs-carousel='{
    "loadingClasses": "opacity-0"
  }' class="relative">
    <div class="hs-carousel relative overflow-hidden w-full h-[70vh] bg-white rounded-lg">
        <div
            class="absolute top-0 bottom-0 flex transition-transform duration-700 opacity-0 hs-carousel-body start-0 flex-nowrap">
            @foreach ($data['image'] as $item)
                <div class="hs-carousel-slide">
                    <div class="flex justify-center h-[70vh] aspect-[4/5] bg-gray-100">
                        <x-curator-glider class="self-center object-cover w-full h-full transition duration-700"
                            :media="$item ?? app(\App\Settings\SitesSettings::class)->no_image" :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button type="button"
        class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/[.1]">
        <span class="text-2xl" aria-hidden="true">
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
            </svg>
        </span>
        <span class="sr-only">Previous</span>
    </button>
    <button type="button"
        class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/[.1]">
        <span class="sr-only">Next</span>
        <span class="text-2xl" aria-hidden="true">
            <svg class="size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
            </svg>
        </span>
    </button>
</div>
