<div
    class="flex flex-col h-full max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-lg dark:shadow-gray-800 dark:bg-gray-900 dark:border-white/10">
    <div class="flex items-center pb-6 border-b border-gray-100 dark:border-gray-800">
        <x-curator-glider class="object-cover w-16 h-16 rounded-full shadow dark:shadow-gray-800" :media="$item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image"
            :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />

        <div class="ps-4">
            <a class="text-lg duration-500 ease-in-out h5">{{ $item->title }}</a>
        </div>
    </div>

    <div class="mt-6">
        <p class="text-slate-500 dark:text-slate-300">{{ $item->excerpt }}</p>
        <ul class="mt-2 mb-0 list-none text-amber-400">
            @for ($i = 0; $i < 5; $i++)
                <li class="inline">
                    @if ($i < $item->rating)
                        <i class="ri-star-fill"></i>
                    @else
                        <i class="ri-star-line"></i>
                    @endif
                </li>
            @endfor
        </ul>
    </div>
</div>
