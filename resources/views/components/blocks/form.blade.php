<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-500 dark:text-slate-300">{{ $data['message'] }}</p>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 md:grid-cols-2 mt-8 items-center gap-[30px]">
    <div class="@if (empty($data['type'])) lg:col-span-12 w-2/3 mx-auto @else lg:col-span-8 @endif">
        <livewire:bolt.fill-form slug="{{ $data['form_name'] }}" inline="true" />
    </div>

    @if ($data['type'] == 'content')
        <div class="lg:col-span-4 @if ($data['image_location'] == 'left') order-first @endif">
            <x-curator-glider class="relative rounded-lg shadow-lg aspect-[3/4] object-cover" :media="$data['image']"
                :srcset="['1200w', '1024w', '640w']" sizes="(max-width: 1200px) 100vw, 1024px" />
        </div>
    @elseif($data['type'] == 'image')
        <div class="lg:col-span-4">
            <x-prose>{!! $data['content'] !!}</x-prose>
        </div>
    @elseif($data['type'] == 'contact_details')
        @php
            $contactDetails = app(\App\Settings\SitesSettings::class);
        @endphp
        <div class="lg:col-span-4">
            <div class="lg:ms-8">
                <div class="flex">
                    <div class="mx-auto text-center icons">
                        <i class="block mb-0 text-2xl rounded ri-phone-line dark:text-white"></i>
                    </div>

                    <div class="flex-1 ms-6">
                        <h5 class="mb-2 text-lg font-medium dark:text-white">Phone</h5>
                        <a href="tel:{{ $contactDetails->phone }}"
                            class="text-slate-400">{{ $contactDetails->phone }}</a>
                    </div>
                </div>

                <div class="flex mt-4">
                    <div class="mx-auto text-center icons">
                        <i class="block mb-0 text-2xl rounded ri-at-line dark:text-white"></i>
                    </div>

                    <div class="flex-1 ms-6">
                        <h5 class="mb-2 text-lg font-medium dark:text-white">Email</h5>
                        <a href="mailto:{{ $contactDetails->email }}"
                            class="text-slate-400">{{ $contactDetails->email }}</a>
                    </div>
                </div>

                <div class="flex mt-4">
                    <div class="mx-auto text-center icons">
                        <i class="block mb-0 text-2xl rounded ri-map-pin-line dark:text-white"></i>
                    </div>

                    <div class="flex-1 ms-6">
                        <h5 class="mb-2 text-lg font-medium dark:text-white">Location</h5>
                        <p class="mb-2 text-slate-400">{{ $contactDetails->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
