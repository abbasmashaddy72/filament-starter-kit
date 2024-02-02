<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>

    <p class="max-w-xl mx-auto text-slate-400 dark:text-slate-300">{{ $data['message'] }}</p>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 mt-8 items-center gap-[30px]">
    <div class="lg:col-span-8">
        <livewire:bolt.fill-form slug="{{ $data['form_name'] }}" inline="true" />
    </div>

    @if (empty($data['content']))
        <div class="lg:col-span-4 @if ($data['image_location'] == 'left') order-first @endif">
            <x-curator-glider class="relative rounded-lg shadow-lg aspect-[3/4] object-cover" :media="$data['image']"
                :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
        </div>
    @else
        <div class="lg:col-span-4">
            <x-prose>
                {!! $data['content'] !!}
            </x-prose>
        </div>
    @endif
</div>
