<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-500 dark:text-slate-300">{{ $data['message'] }}</p>
</div>

<div
    class="grid @if (class_basename($data['data']) == 'Testimonial' || class_basename($data['data']) == 'Post') lg:grid-cols-3 @else lg:grid-cols-4 @endif md:grid-cols-2 grid-cols-1 mt-4 gap-[30px]">
    @if (isset($data['data']) && class_exists($data['data']))
        @php
            $modelClass = $data['data'];
            $modelData = app($modelClass);

            // Check if the model has the getDynamicRelationships method
            $withRelations = method_exists($modelData, 'getDynamicRelationships') ? $modelData->getDynamicRelationships() : [];

            $items = $modelData
                ->when(count($withRelations) > 0, function ($query) use ($withRelations) {
                    return $query->with($withRelations);
                })
                ->where('status', 'published')
                ->take((int) $data['count'])
                ->get();
        @endphp
        @foreach ($items as $item)
            @if (class_basename($modelClass) == 'Testimonial')
                <x-card.testimonial :item="$item" />
            @else
                @if ($data['type'] == 'only_text')
                    <x-card.only-image :title="$item->title" :content="$item->excerpt ?? $item->content" :route="route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug])" />
                @elseif($data['type'] == 'button_text')
                    <x-card.button-text :title="$item->title" :content="$item->excerpt ?? $item->content" :route="route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug])" />
                @elseif($data['type'] == 'icon')
                    <x-card.icon :title="$item->title" :content="$item->excerpt ?? $item->content" :route="route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug])" :icon="$item->icon" />
                @elseif($data['type'] == 'image')
                    @if ($data['image_location'] == 'top')
                        <x-card.top :title="$item->title" :content="$item->excerpt ?? ($this->meta->description ?? $item->content)" :route="route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug])" :imageId="$item->meta->ogImage->id ?? $item->image->id" />
                    @else
                        <x-card.right-left :title="$item->title" :content="$item->excerpt ?? ($this->meta->description ?? $item->content)" :route="route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug])" :imageId="$item->meta->ogImage->id ?? $item->image->id"
                            :imageLocation="$item->image_location" />
                    @endif
                @endif
            @endif
        @endforeach
    @else
        @foreach ($data['items'] as $item)
            @if ($data['type'] == 'only_text')
                <x-card.only-image :title="$item['title']" :content="$item['content']" :route="$item['button_url'] ?? '#'" />
            @elseif($data['type'] == 'button_text')
                <x-card.button-text :title="$item['title']" :content="$item['content']" :route="$item['button_url'] ?? '#'" :buttonText="$item['button_text']" />
            @elseif($data['type'] == 'icon')
                <x-card.icon :title="$item['title']" :content="$item['content']" :route="$item['button_url'] ?? '#'" :icon="$item['icon']" />
            @elseif($data['type'] == 'image')
                @if ($data['image_location'] == 'top')
                    <x-card.top :title="$item['title']" :content="$item['content']" :route="$item['button_url']" :imageId="$item->meta->ogImage->id ?? $item->image->id" />
                @else
                    <x-card.right-left :title="$item['title']" :content="$item['content']" :route="$item['button_url']" :imageId="$item->meta->ogImage->id ?? $item->image->id"
                        :imageLocation="$item['image_location']" />
                @endif
            @endif
        @endforeach
    @endif
</div>
