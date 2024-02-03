<nav class="navbar" id="navbar">
    <div class="container flex flex-wrap items-center justify-end">
        @if (!empty($siteSettings->dark_logo) && !empty($siteSettings->light_logo))
            <a class="navbar-brand md:me-8" href="{{ route('welcome') }}">
                <span class="inline-block dark:hidden">
                    <img src="{{ $siteSettings->dark_logo }}" class="w-auto h-20 l-dark" alt="">
                    <img src="{{ $siteSettings->light_logo }}" class="w-auto h-20 l-light" alt="">
                </span>
                <img src="{{ $siteSettings->light_logo }}" class="hidden w-auto h-20 dark:inline-block" alt="">
            </a>
        @else
            <a class="text-3xl navbar-brand md:me-8 " href="{{ route('welcome') }}">
                <span class="text-black dark:text-white l-dark">{{ config('app.name') }}</span>
                <span class="text-white dark:text-black l-light">{{ config('app.name') }}</span>
            </a>
        @endif

        <div class="flex items-center nav-icons lg_992:order-2 ms-auto lg:ms-4">
            <ul class="mb-0 list-none menu-social">
                @foreach ($menu->where('location', 'headerButtons')->pluck('items') as $items)
                    @foreach ($items as $translation)
                        <li class="inline">
                            <a href="{{ $translation['url'] }}"
                                class="inline-flex items-center justify-center p-2 text-base font-normal tracking-wide text-center text-white align-middle transition duration-500 ease-in-out bg-primary-400 border border-primary-400 rounded-md hover:bg-primary-500 hover:border-primary-500">
                                {{ $translation['title'] }}
                            </a>
                        </li>
                    @endforeach
                @endforeach
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
                            <a class="nav-link active" href="{{ $translation['url'] }}">{{ $translation['title'] }}</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    </div>
</nav>
