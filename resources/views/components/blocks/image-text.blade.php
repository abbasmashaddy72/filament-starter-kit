<div class="grid items-center grid-cols-1 gap-10 lg:grid-cols-12 md:grid-cols-2">
    <div class="lg:col-span-5 @if ($data['image_location'] != 'left') order-last @endif">
        <x-curator-glider class="relative rounded-lg shadow-lg aspect-[3/4] object-cover" :media="$data['image']"
            :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
    </div>

    <div class="lg:col-span-7">
        <div class="lg:ms-7">
            <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
            <x-blocks.rich-text :content="$data['content']" />
        </div>
    </div>
</div>
