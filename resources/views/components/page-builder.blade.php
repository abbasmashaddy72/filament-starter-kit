@foreach ($content as $container)
    <section @class([
        'relative py-16 md:py-24',
        'bg-primary-500 dark:bg-primary-700' => $container['bg_color'] == 'primary',
        'bg-secondary-500 dark:bg-secondary-700' =>
            $container['bg_color'] == 'secondary',
        'bg-tertiary-500 dark:bg-tertiary-700' =>
            $container['bg_color'] == 'tertiary',
        'bg-accent-500 dark:bg-accent-700' => $container['bg_color'] == 'accent',
        'bg-gray-300 dark:bg-gray-700' => $container['bg_color'] == 'gray',
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
