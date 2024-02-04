@foreach ($content as $container)
    <section @class([
        'relative py-16 md:py-24',
        'dark:bg-slate-700 bg-slate-200' => $container['bg_color'] == 'Slate',
        'dark:bg-red-700 bg-red-200' => $container['bg_color'] == 'Red',
        'dark:bg-orange-700 bg-orange-200' => $container['bg_color'] == 'Orange',
        'dark:bg-amber-700 bg-amber-200' => $container['bg_color'] == 'Amber',
        'dark:bg-yellow-700 bg-yellow-200' => $container['bg_color'] == 'Yellow',
        'dark:bg-lime-700 bg-lime-200' => $container['bg_color'] == 'Lime',
        'dark:bg-green-700 bg-green-200' => $container['bg_color'] == 'Green',
        'dark:bg-emerald-700 bg-emerald-200' => $container['bg_color'] == 'Emerald',
        'dark:bg-teal-700 bg-teal-200' => $container['bg_color'] == 'Teal',
        'dark:bg-cyan-700 bg-cyan-200' => $container['bg_color'] == 'Cyan',
        'dark:bg-sky-700 bg-sky-200' => $container['bg_color'] == 'Sky',
        'dark:bg-blue-700 bg-blue-200' => $container['bg_color'] == 'Blue',
        'dark:bg-indigo-700 bg-indigo-200' => $container['bg_color'] == 'Indigo',
        'dark:bg-violet-700 bg-violet-200' => $container['bg_color'] == 'Violet',
        'dark:bg-purple-700 bg-purple-200' => $container['bg_color'] == 'Purple',
        'dark:bg-fuchsia-700 bg-fuchsia-200' => $container['bg_color'] == 'Fuchsia',
        'dark:bg-pink-700 bg-pink-200' => $container['bg_color'] == 'Pink',
        'dark:bg-rose-700 bg-rose-200' => $container['bg_color'] == 'Rose',
    ])>
        <div class="container mx-auto content">
            @if ($container['blocks'])
                <x-blocks :blocks="$container['blocks']" />
            @endif
        </div>
        @if ($container['bg_color'] == 'half')
            <div class="absolute bottom-0 bg-primary-400 end-0 start-0 h-4/5 md:h-2/3"></div>
        @endif
    </section>
@endforeach
