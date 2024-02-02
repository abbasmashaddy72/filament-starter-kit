@props([
    'loading' => 'eager',
])

<aside
    class="relative flex items-center justify-center min-h-[256px] md:min-h-[322px] lg:min-h-[448px] filament-gradient pt-16">
    @if ($type == 'image' && ($media || $cta))
        <x-curator-glider class="absolute inset-0 z-0 object-cover w-full h-full opacity-20" :media="$media->id"
            :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" height="{{ $media->height }}"
            width="{{ $media->width }}" />
        <div class="container z-10 hero">
            <x-prose>
                {!! $cta !!}
            </x-prose>
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
        <div class="container z-10 py-8">
            <iframe src="{{ $media['embed_url'] }}?{{ http_build_query($params) }}"
                width="{{ $media['responsive'] ? $media['width'] : ($media['width'] ?: '640') }}"
                height="{{ $media['responsive'] ? $media['height'] : ($media['height'] ?: '480') }}" frameborder="0"
                allow="autoplay; fullscreen; picture-in-picture" allowfullscreen style="{{ $styles }}"></iframe>
            <p class="mt-8 text-2xl font-bold text-center text-white drop-shadow-md">{{ $cta }}</p>
        </div>
    @else
        {{ $slot }}
    @endif
</aside>
