<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-400">{{ $data['message'] }}</p>
</div>

<div id="accordion-color" data-accordion="collapse"
    data-active-classes="bg-primary-100 dark:bg-gray-800 text-primary-600 dark:text-white">
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
            <x-accordion.item :title="$item->question" :content="$item->answer" :loop="$loop" />
        @endforeach
    @else
        @foreach ($data['items'] as $item)
            <x-accordion.item :title="$item['title']" :content="$item['content']" :loop="$loop" />
        @endforeach
    @endif
</div>
