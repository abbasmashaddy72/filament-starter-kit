<div class="grid grid-cols-1 pb-8 text-center">
    <h3 class="mb-4 text-xl font-medium md:text-2xl">{{ $data['title'] }}</h3>
    <p class="max-w-xl mx-auto text-slate-500 dark:text-slate-300">{{ $data['message'] }}</p>
</div>

<div
    class="grid {{ class_basename($data['data']) == 'Testimonial' || class_basename($data['data']) == 'Post' ? 'lg:grid-cols-3' : 'lg:grid-cols-4' }} md:grid-cols-2 grid-cols-1 mt-4 gap-[30px]">
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
            @php
                $title = $item->title ?? '';
                $content = $item->excerpt ?? ($item->content ?? '');
                $route = !empty($content) && Route::has(strtolower(class_basename($modelClass)) . '.show') ? route(strtolower(class_basename($modelClass)) . '.show', ['page' => $item->slug]) : '#';
            @endphp

            @if (class_basename($modelClass) == 'Testimonial')
                <x-card.testimonial :item="$item" />
            @elseif (class_basename($modelClass) == 'Project')
                <x-card.project :item="$item" :route="$route" />
            @else
                @if ($data['type'] == 'only_text')
                    <x-card.only-image :title="$title" :content="$content" :route="$route" />
                @elseif($data['type'] == 'button_text')
                    <x-card.button-text :title="$title" :content="$content" :route="$route" />
                @elseif($data['type'] == 'icon')
                    <x-card.icon :title="$title" :content="$content" :route="$route" :icon="$item->icon ?? ''" />
                @elseif($data['type'] == 'image')
                    @if ($data['image_location'] == 'top')
                        <x-card.top :title="$title" :content="$content" :route="$route" :imageId="$item->meta->ogImage->id ??
                            ($item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image)" />
                    @else
                        <x-card.right-left :title="$title" :content="$content" :route="$route" :imageId="$item->meta->ogImage->id ??
                            ($item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image)"
                            :imageLocation="$item->image_location ?? ''" />
                    @endif
                @endif
            @endif
        @endforeach
    @else
        @foreach ($data['items'] as $item)
            @php
                $title = $item['title'] ?? '';
                $content = $item['content'] ?? '';
                $route = !empty($content) ? $item['button_url'] ?? '#' : '#';
            @endphp

            @if ($data['type'] == 'only_text')
                <x-card.only-image :title="$title" :content="$content" :route="$route" />
            @elseif($data['type'] == 'button_text')
                <x-card.button-text :title="$title" :content="$content" :route="$route" :buttonText="$item['button_text'] ?? ''" />
            @elseif($data['type'] == 'icon')
                <x-card.icon :title="$title" :content="$content" :route="$route" :icon="$item['icon'] ?? ''" />
            @elseif($data['type'] == 'image')
                @if ($data['image_location'] == 'top')
                    <x-card.top :title="$title" :content="$content" :route="$route" :imageId="$item->meta->ogImage->id ??
                        ($item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image)" />
                @else
                    <x-card.right-left :title="$title" :content="$content" :route="$route" :imageId="$item->meta->ogImage->id ??
                        ($item->image->id ?? app(\App\Settings\SitesSettings::class)->no_image)"
                        :imageLocation="$item['image_location'] ?? ''" />
                @endif
            @endif
        @endforeach
    @endif
</div>
