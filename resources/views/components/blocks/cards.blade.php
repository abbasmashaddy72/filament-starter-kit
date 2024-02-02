<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>

    <p class="max-w-xl mx-auto text-slate-400">{{ $data['message'] }}</p>
</div>

<div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 mt-4 gap-[30px]">
    @foreach ($data['items'] as $item)
        <div
            class="w-full max-w-sm py-4 text-center transition duration-500 ease-in-out bg-white border border-gray-200 rounded-lg shadow group dark:bg-gray-800 dark:border-gray-700">
            <div class="relative -m-3 text-transparent">
                <x-ri-hexagon-fill class='block mx-auto h-28 w-28 text-yellow-400/15' />
                <x-dynamic-component :component="$item['icon']"
                    class="absolute flex items-center justify-center w-16 h-16 mx-auto text-yellow-400 align-middle transition duration-500 ease-in-out top-2/4 -translate-y-2/4 start-0 end-0 rounded-xl" />
            </div>

            <div class="mt-6">
                <a href="{{ $item['button_url'] ?? '#' }}"
                    class="text-lg transition duration-500 ease-in-out h5 hover:text-yellow-400">{{ $item['title'] }}</a>
                <x-prose>
                    {!! $item['content'] !!}
                </x-prose>
            </div>
        </div>
    @endforeach
</div>
