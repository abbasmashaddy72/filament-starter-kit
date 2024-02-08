<div class="grid justify-center grid-cols-1">
    <div class="relative z-1">
        <div class="grid justify-center grid-cols-1 text-center lg:grid-cols-12 md:text-start">
            <div class="lg:col-start-2 lg:col-span-10">
                <div class="relative">
                    <x-curator-glider class="object-cover rounded-md shadow-lg aspect-video" :media="$data['image']"
                        :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
                    <img src="assets/images/cta.jpg" class="rounded-md shadow-lg" alt="">
                    <div class="absolute text-center bottom-2/4 translate-y-2/4 end-0 start-0">
                        <a href="#!" data-type="youtube"
                            data-id="{{ $videoId = preg_replace('/.*[?&]v=([^&]+).*/', '$1', $data['video_url']) }}"
                            class="inline-flex items-center justify-center w-16 h-16 mx-auto duration-500 ease-in-out bg-white rounded-full shadow-lg text-primary-400 lightbox lg:h-20 lg:w-20 dark:shadow-gray-800 hover:bg-primary-400 hover:text-white">
                            <i class="inline-flex items-center justify-center text-3xl ri-play-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @if (!empty($data['message']) || !empty($data['title']) || !empty($data['button_text']) || !empty($data['button_url']))
            <div class="content md:mt-8">
                <div class="grid justify-center grid-cols-1 text-center lg:grid-cols-12 md:text-start">
                    <div class="lg:col-start-2 lg:col-span-10">
                        <div class="grid md:grid-cols-2 grid-cols-1 items-center gap-[30px]">
                            <div class="mt-8">
                                <div class="section-title text-md-start">
                                    <h3 class="text-xl font-medium text-white md:text-2xl">{{ $data['title'] }}</h3>
                                </div>
                            </div>

                            <div class="section-title text-md-start">
                                <p class="max-w-xl mx-auto mb-2 text-gray-50">{{ $data['message'] }}</p>
                                <a href="{{ $data['button_url'] }}"
                                    class="inline-flex items-center justify-center p-2 text-base font-normal tracking-wide text-center text-white align-middle transition duration-500 ease-in-out border rounded-md bg-info-600 border-info-600 hover:bg-info-500 hover:border-info-500">
                                    {{ $data['button_text'] }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
