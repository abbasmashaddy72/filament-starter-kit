<footer class="relative text-gray-200 footer bg-slate-950 dark:text-gray-200">
    <div class="container">
        <div class="grid grid-cols-12">
            <div class="col-span-12">
                <div class="py-[60px] px-0">
                    <div class="grid grid-cols-1">
                        <div class="text-center">
                            @if (!empty($siteSettings->dark_logo) && !empty($siteSettings->light_logo))
                                <a class="" href="{{ route('welcome') }}">
                                    <img src="{{ $siteSettings->light_logo }}" class="block w-auto h-24 mx-auto"
                                        alt="">
                                </a>
                            @else
                                <a class="" href="{{ route('welcome') }}">
                                    <span
                                        class="block w-auto mx-auto text-5xl text-white">{{ config('app.name') }}</span>
                                </a>
                            @endif
                            <p class="max-w-xl mx-auto mt-8 text-slate-400">{{ $siteSettings->description }}</p>
                        </div>

                        <ul class="mt-8 space-x-2 text-center list-none footer-list">
                            @foreach ($menu->where('location', 'footer1')->pluck('items') as $items)
                                @foreach ($items as $translation)
                                    <li class="inline px-2">
                                        <a class="text-gray-300 duration-500 ease-in-out hover:text-gray-400"
                                            href="{{ $translation['url'] }}">{{ $translation['title'] }}</a>
                                    </li>
                                @endforeach
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-[30px] px-0 border-t border-slate-800">
        <div class="container text-center">
            <div class="grid items-center md:grid-cols-12">
                <div class="md:col-span-6">
                    <div class="text-center md:text-start">
                        <p class="text-gray-400">© {{ date('Y') }}. All rights are belonging to
                            {{ config('app.name') }}.
                        </p>
                    </div>
                </div>

                <div class="mt-8 md:col-span-6 md:mt-0">
                    <ul class="text-center list-none md:text-end">
                        @foreach ($siteSettings->social as $item)
                            <li class="inline">
                                <a href="{{ $item['link'] }}" target="_blank"
                                    class="inline-flex items-center justify-center w-8 h-8 text-base font-normal tracking-wide text-center align-middle transition duration-500 ease-in-out border border-gray-800 rounded-md hover:border-primary-400 dark:hover:border-primary-400 hover:bg-primary-400 dark:hover:bg-primary-400">
                                    <i class="align-middle {{ $item['icon'] }}"
                                        title="{{ ucfirst($item['platform']) }}"></i>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
