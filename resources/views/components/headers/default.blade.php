<nav class="navbar" id="navbar">
    <div class="container flex flex-wrap items-center justify-end">
        @if (!empty($siteSettings->dark_logo) && !empty($siteSettings->light_logo))
            <a class="navbar-brand md:me-8" href="{{ route('welcome') }}">
                <span class="inline-block dark:hidden">
                    <x-curator-glider class="w-auto h-20 l-dark" :media="$siteSettings->dark_logo" :srcset="['1200w', '1024w', '640w']"
                        sizes="(max-width: 1200px) 100vw, 1024px" />
                    <x-curator-glider class="w-auto h-20 l-light" :media="$siteSettings->light_logo" :srcset="['1200w', '1024w', '640w']"
                        sizes="(max-width: 1200px) 100vw, 1024px" />
                </span>
                <x-curator-glider class="hidden w-auto h-20 dark:inline-block" :media="$siteSettings->light_logo" :srcset="['1200w', '1024w', '640w']"
                    sizes="(max-width: 1200px) 100vw, 1024px" />
            </a>
        @else
            <a class="text-3xl navbar-brand md:me-8 " href="{{ route('welcome') }}">
                <span class="text-black dark:text-white l-dark">{{ config('app.name') }}</span>
                <span class="text-white dark:text-black l-light">{{ config('app.name') }}</span>
            </a>
        @endif

        <div class="flex items-center nav-icons lg_992:order-2 ms-auto lg:ms-4">
            <ul class="mb-0 space-x-2 list-none menu-social">
                @foreach ($menu->where('location', 'headerButtons')->pluck('items') as $items)
                    @foreach ($items as $translation)
                        <li class="inline">
                            <a href="{{ $translation['url'] }}"
                                @if ($translation['blank']) target="__blank" @endif
                                class="inline-flex items-center justify-center p-2 text-base font-normal tracking-wide text-center text-white align-middle transition duration-500 ease-in-out border rounded-md bg-primary-500 border-primary-500 hover:bg-primary-600 hover:border-primary-500">
                                {{ $translation['title'] }}
                            </a>
                        </li>
                    @endforeach
                @endforeach
                @if (count(config('laravellocalization.supportedLocales')) > 1)
                    <li class="inline">
                        <button id="dropdownDefaultButton" data-dropdown-toggle="dropdown"
                            class="text-white bg-primary-500 hover:bg-primary-600 focus:ring-4 focus:outline-none focus:ring-primary-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                            type="button">
                            {{ strtoupper(LaravelLocalization::getCurrentLocale()) }}
                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>

                        <div id="dropdown"
                            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                aria-labelledby="dropdownDefaultButton">
                                @foreach (config('laravellocalization.supportedLocales') as $localeCode => $properties)
                                    <li>
                                        <a rel="alternate" hreflang="{{ $localeCode }}"
                                            href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                            class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ $properties['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
            <div x-data="{ isOpen: false }">
                <button @click="isOpen = !isOpen" type="button" data-collapse="menu-collapse"
                    class="inline-flex items-center collapse-btn ms-3 text-slate-950 dark:text-white lg_992:hidden"
                    aria-controls="menu-collapse" :aria-expanded="isOpen.toString()">
                    <span class="sr-only">Navigation Menu</span>
                    <i x-show="!isOpen" class="ri-menu-line text-[24px]"></i>
                    <i x-show="isOpen" class="ri-close-line text-[24px]"></i>
                </button>
            </div>
        </div>
        <div class="hidden navigation lg_992:order-1 lg_992:flex me-auto" id="menu-collapse">
            <ul class="navbar-nav nav-light" id="navbar-navlist">
                @foreach ($menu->where('location', 'header')->pluck('items') as $items)
                    @foreach ($items as $translation)
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ $translation['url'] }}"
                                @if ($translation['blank']) target="__blank" @endif>{{ $translation['title'] }}</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</nav>
