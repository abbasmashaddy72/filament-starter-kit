@props([
    'loading' => 'eager',
])

<aside
    class="relative flex items-center justify-center @if (Route::currentRouteName() === 'welcome') min-h-[80vh] @else min-h-[35vh] @endif pt-20">
    @if ($type == 'image' && ($media || $cta))
        <div class="absolute inset-0 bg-slate-950/85"></div>
        <x-curator-glider class="absolute inset-0 z-0 object-cover w-full h-full opacity-20" :media="$media->id ?? app(\App\Settings\SitesSettings::class)->no_image"
            :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" height="{{ $media->height }}"
            width="{{ $media->width }}" />
        <div class="container z-10 hero">
            @if (Route::currentRouteName() == 'welcome')
                <x-prose class="md:w-4/5">
                    {!! $cta !!}
                </x-prose>
            @else
                <x-prose class="text-3xl font-bold text-center">
                    {!! $cta !!}
                </x-prose>
            @endif
        </div>
    @elseif ($type == 'oembed' && ($media || $cta))
        @php
            $styles = $media['responsive'] ? "aspect-ratio: {$media['width']} / {$media['height']}; width: 100%; height: auto;" : null;
            $params = [
                'autoplay' => $media['autoplay'] ? 1 : 0,
                'loop' => $media['loop'] ? 1 : 0,
                'title' => $media['show_title'] ? 1 : 0,
                'byline' => $media['byline'] ? 1 : 0,
                'portrait' => $media['portrait'] ? 1 : 0,
            ];
        @endphp
        <div class="container z-10 hero">
            <x-prose>
                {!! $cta !!}
            </x-prose>
        </div>

        <div class="container z-10 py-8">
            <iframe src="{{ $media['embed_url'] }}?{{ http_build_query($params) }}"
                width="{{ $media['responsive'] ? $media['width'] : ($media['width'] ?: '640') }}"
                height="{{ $media['responsive'] ? $media['height'] : ($media['height'] ?: '480') }}" frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="{{ $styles }}"></iframe>
        </div>
    @else
        {{ $slot }}
    @endif
</aside>
