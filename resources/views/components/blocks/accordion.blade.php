<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-500 dark:text-slate-300">{{ $data['message'] }}</p>
</div>

<div id="accordion-color" data-accordion="collapse"
    data-active-classes="bg-primary-100 dark:bg-gray-900 text-primary-600 dark:text-white">
    @if (isset($data['data']) && class_exists($data['data']))
        @php
            $modelClass = $data['data'];
            $modelData = app($modelClass);

            // Check if the model has the getDynamicRelationships method
            $withRelations = method_exists($modelData, 'getDynamicRelationships') ? $modelData->getDynamicRelationships() : [];

            $query = $modelData->where('status', 'published');

            if ($data['count'] !== null) {
                $query->take((int) $data['count']);
            }

            $items = $query
                ->when(count($withRelations) > 0, function ($query) use ($withRelations) {
                    return $query->with($withRelations);
                })
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
