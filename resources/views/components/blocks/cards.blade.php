<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-400">{{ $data['message'] }}</p>
</div>

<div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 mt-4 gap-[30px]">
    @if (isset($data['data']) && class_exists($data['data']))
        @php
            $modelClass = $data['data'];
            $modelData = app($modelClass);
            $items = $modelData
                ->where('status', 'published')
                ->take((int) $data['count'])
                ->get();
        @endphp
        @foreach ($items as $item)
            @if (class_basename($modelClass) == 'Testimonial')
                <div class="space-y-8">
                    <li class="p-6 bg-white rounded-lg shadow-lg dark:shadow-gray-800 dark:bg-slate-900">
                        <div class="flex items-center pb-6 border-b border-gray-100 dark:border-gray-800">
                            <x-curator-glider class="object-cover w-16 h-16 rounded-full shadow dark:shadow-gray-800"
                                :media="$item->image->id" :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />

                            <div class="ps-4">
                                <a
                                    class="text-lg duration-500 ease-in-out h5 hover:text-primary-400">{{ $item->title }}</a>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-slate-400">{{ $item->excerpt }}</p>
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
                    </li>
                </div>
            @else
                @if ($data['type'] == 'only_text')
                    <a href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}"
                        class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                            {{ $item->title }}
                        </h5>
                        <x-prose>
                            {!! $item->excerpt ?? $item->content !!}
                        </x-prose>
                    </a>
                @elseif($data['type'] == 'button_text')
                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a
                            href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                {{ $item->title }}</h5>
                        </a>
                        <x-prose>
                            {!! $item->excerpt ?? $item->content !!}
                        </x-prose>
                        <a href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}"
                            class="inline-flex items-center px-3 py-2 mt-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            {{ $item['button_text'] ?? 'Read More' }}
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </a>
                    </div>
                @elseif($data['type'] == 'icon')
                    <div
                        class="w-full max-w-sm py-4 text-center transition duration-500 ease-in-out bg-white border border-gray-200 rounded-lg shadow group dark:bg-gray-800 dark:border-gray-700">
                        <div class="relative -m-3 text-transparent">
                            <x-ri-hexagon-fill class='block mx-auto h-28 w-28 text-primary-400/15' />
                            <x-dynamic-component :component="$item['icon']"
                                class="absolute flex items-center justify-center w-16 h-16 mx-auto align-middle transition duration-500 ease-in-out text-primary-400 top-2/4 -translate-y-2/4 start-0 end-0 rounded-xl" />
                        </div>

                        <div class="mt-6">
                            <a href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}"
                                class="text-lg transition duration-500 ease-in-out h5 hover:text-primary-400">{{ $item->title }}</a>
                            <x-prose>
                                {!! $item->excerpt ?? $item->content !!}
                            </x-prose>
                        </div>
                    </div>
                @elseif($data['type'] == 'image')
                    @if ($data['image_location'] == 'top')
                        <div
                            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a
                                href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}">
                                <x-curator-glider class="object-cover w-full rounded-t-lg aspect-video"
                                    :media="$item->meta->ogImage->id ?? $item->image->id" :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                            </a>
                            <div class="p-5">
                                <a
                                    href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}">
                                    <h5
                                        class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                        {{ $item->title }}</h5>
                                </a>
                                <x-prose>
                                    {!! $item->excerpt ?? $item->content !!}
                                </x-prose>
                                <a href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}"
                                    class="inline-flex items-center px-3 py-2 mt-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    {{ $item['button_text'] ?? 'Read More' }}
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <a href="{{ route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) }}"
                            class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                            <x-curator-glider :class="implode(' ', [
                                'object-cover',
                                'w-full',
                                'h-96',
                                'md:h-auto',
                                'md:w-48',
                                'aspect-square',
                                $item['image_location'] == 'left' ? 'order-last' : null,
                                $item['image_location'] == 'left' ? 'rounded-r-lg' : 'rounded-l-lg',
                            ])" :media="$item->meta->ogImage->id ?? $item->image->id" :srcset="['1200w', '1024w', '640w']"
                                sizes="(max-width: 1200px) 100vw, 1024px" />
                            <div class="flex flex-col justify-between p-4 leading-normal">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                    {{ $item->title }}
                                </h5>
                                <x-prose>
                                    {!! $item->excerpt ?? $item->content !!}
                                </x-prose>
                            </div>
                        </a>
                    @endif
                @endif
            @endif
        @endforeach
    @else
        @foreach ($data['items'] as $item)
            {{-- @dd($data) --}}
            @if ($data['type'] == 'only_text')
                <a href="{{ $item['button_url'] ?? '#' }}"
                    class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                        {{ $item['title'] }}
                    </h5>
                    <x-prose>
                        {!! $item['content'] !!}
                    </x-prose>
                </a>
            @elseif($data['type'] == 'button_text')
                <div
                    class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="{{ $item['button_url'] ?? '#' }}">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                            {{ $item['title'] }}</h5>
                    </a>
                    <x-prose>
                        {!! $item['content'] !!}
                    </x-prose>
                    <a href="{{ $item['button_url'] ?? '#' }}"
                        class="inline-flex items-center px-3 py-2 mt-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        {{ $item['button_text'] }}
                        <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </a>
                </div>
            @elseif($data['type'] == 'icon')
                <div
                    class="w-full max-w-sm py-4 text-center transition duration-500 ease-in-out bg-white border border-gray-200 rounded-lg shadow group dark:bg-gray-800 dark:border-gray-700">
                    <div class="relative -m-3 text-transparent">
                        <x-ri-hexagon-fill class='block mx-auto h-28 w-28 text-primary-400/15' />
                        <x-dynamic-component :component="$item['icon']"
                            class="absolute flex items-center justify-center w-16 h-16 mx-auto align-middle transition duration-500 ease-in-out text-primary-400 top-2/4 -translate-y-2/4 start-0 end-0 rounded-xl" />
                    </div>

                    <div class="mt-6">
                        <a href="{{ $item['button_url'] ?? '#' }}"
                            class="text-lg transition duration-500 ease-in-out h5 hover:text-primary-400">{{ $item['title'] }}</a>
                        <x-prose>
                            {!! $item['content'] !!}
                        </x-prose>
                    </div>
                </div>
            @elseif($data['type'] == 'image')
                @if ($data['image_location'] == 'top')
                    <div
                        class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="{{ $item['button_url'] ?? '#' }}">
                            <x-curator-glider class="object-cover w-full rounded-t-lg aspect-video" :media="$item['image']"
                                :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                        </a>
                        <div class="p-5">
                            <a href="{{ $item['button_url'] ?? '#' }}">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                    {{ $item['title'] }}</h5>
                            </a>
                            <x-prose>
                                {!! $item['content'] !!}
                            </x-prose>
                            <a href="{{ $item['button_url'] ?? '#' }}"
                                class="inline-flex items-center px-3 py-2 mt-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                {{ $item['button_text'] }}
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @else
                    <a href="{{ $item['button_url'] ?? '#' }}"
                        class="flex flex-col items-center bg-white border border-gray-200 rounded-lg shadow md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <x-curator-glider :class="implode(' ', [
                            'object-cover',
                            'w-full',
                            'h-96',
                            'md:h-auto',
                            'md:w-48',
                            'aspect-square',
                            $item['image_location'] == 'left' ? 'order-last' : null,
                            $item['image_location'] == 'left' ? 'rounded-r-lg' : 'rounded-l-lg',
                        ])" :media="$item['image']" :srcset="['1200w', '1024w', '640w']"
                            sizes="(max-width: 1200px) 100vw, 1024px" />
                        <div class="flex flex-col justify-between p-4 leading-normal">
                            <h5
                                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white line-clamp-1">
                                {{ $item['title'] }}
                            </h5>
                            <x-prose>
                                {!! $item['content'] !!}
                            </x-prose>
                        </div>
                    </a>
                @endif
            @endif
        @endforeach
    @endif
</div>
