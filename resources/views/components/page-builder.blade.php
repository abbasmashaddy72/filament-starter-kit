@foreach ($content as $container)
    <section id="{{ generateSectionId($container['blocks'][0]['data']['title'] ?? '') }}" @class([
        'relative py-16 md:py-24',
        'dark:bg-slate-700 bg-slate-100' => $container['bg_color'] == 'Slate',
        'dark:bg-red-700 bg-red-100' => $container['bg_color'] == 'Red',
        'dark:bg-orange-700 bg-orange-100' => $container['bg_color'] == 'Orange',
        'dark:bg-amber-700 bg-amber-100' => $container['bg_color'] == 'Amber',
        'dark:bg-yellow-700 bg-yellow-100' => $container['bg_color'] == 'Yellow',
        'dark:bg-lime-700 bg-lime-100' => $container['bg_color'] == 'Lime',
        'dark:bg-green-700 bg-green-100' => $container['bg_color'] == 'Green',
        'dark:bg-emerald-700 bg-emerald-100' => $container['bg_color'] == 'Emerald',
        'dark:bg-teal-700 bg-teal-100' => $container['bg_color'] == 'Teal',
        'dark:bg-cyan-700 bg-cyan-100' => $container['bg_color'] == 'Cyan',
        'dark:bg-sky-700 bg-sky-100' => $container['bg_color'] == 'Sky',
        'dark:bg-blue-700 bg-blue-100' => $container['bg_color'] == 'Blue',
        'dark:bg-indigo-700 bg-indigo-100' => $container['bg_color'] == 'Indigo',
        'dark:bg-violet-700 bg-violet-100' => $container['bg_color'] == 'Violet',
        'dark:bg-purple-700 bg-purple-100' => $container['bg_color'] == 'Purple',
        'dark:bg-fuchsia-700 bg-fuchsia-100' => $container['bg_color'] == 'Fuchsia',
        'dark:bg-pink-700 bg-pink-100' => $container['bg_color'] == 'Pink',
        'dark:bg-gray-700 bg-gray-100' => $container['bg_color'] == 'Gray',
        'dark:bg-zinc-700 bg-zinc-100' => $container['bg_color'] == 'Zinc',
        'dark:bg-neutral-700 bg-neutral-100' => $container['bg_color'] == 'Neutral',
        'dark:bg-stone-700 bg-stone-100' => $container['bg_color'] == 'Stone',
        'dark:bg-rose-700 bg-rose-100' => $container['bg_color'] == 'Rose',
    ])>
        <div class="container mx-auto content">
            @if ($container['blocks'])
                <x-blocks :blocks="$container['blocks']" />
            @endif
        </div>
        @if ($container['bg_color'] == 'half')
            <div
                class="absolute bottom-0 bg-primary-400 end-0 start-0 @if (empty($container['blocks'][0]['data']['title'])) h-2/4 @else h-2/3 @endif">
            </div>
        @endif
    </section>
@endforeach
