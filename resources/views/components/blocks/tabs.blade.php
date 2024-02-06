@if (!empty($items))
    <div class="mb-4 border-b border-gray-200 render-block render-block__tabs dark:border-gray-700"
        x-data="{
            selectedId: null,
            init() {
                // Set the first available tab on the page on page load.
                this.$nextTick(() => this.select(this.$id('tab', 1)))
            },
            select(id) {
                this.selectedId = id
            },
            isSelected(id) {
                return this.selectedId === id
            },
            whichChild(el, parent) {
                return Array.from(parent.children).indexOf(el) + 1
            }
        }" x-id="['tab']">

        <!-- Tab List -->
        <ul x-ref="tablist" @keydown.right.prevent.stop="$focus.wrap().next()" @keydown.home.prevent.stop="$focus.first()"
            @keydown.page-up.prevent.stop="$focus.first()" @keydown.left.prevent.stop="$focus.wrap().prev()"
            @keydown.end.prevent.stop="$focus.last()" @keydown.page-down.prevent.stop="$focus.last()" role="tablist"
            class="flex flex-wrap -mb-px text-sm font-medium text-center">

            @foreach ($items as $tab)
                <li>
                    <button :id="$id('tab', whichChild($el.parentElement, $refs.tablist))" @click="select($el.id)"
                        @mousedown.prevent @focus="select($el.id)" type="button"
                        :tabindex="isSelected($el.id) ? 0 : -1" :aria-selected="isSelected($el.id)"
                        :class="isSelected($el.id) ? 'border-primary-500' : 'border-transparent'"
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        role="tab">{{ $tab->title }}</button>
                </li>
            @endforeach
        </ul>

        <div role="tabpanels" class="rounded-lg bg-gray-50 dark:bg-gray-800">
            @foreach ($items as $panel)
                <section x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                    :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))" role="tabpanel" class="p-8">
                    @foreach ($panel->content as $key => $value)
                        @if (isset($value['blocks']))
                            @foreach ($value['blocks'] as $block)
                                <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
                            @endforeach
                        @endif
                    @endforeach
                </section>
            @endforeach
        </div>
    </div>
@else
    <div class="mb-4 border-b border-gray-200 render-block render-block__tabs dark:border-gray-700"
        x-data="{
            selectedId: null,
            init() {
                // Set the first available tab on the page on page load.
                this.$nextTick(() => this.select(this.$id('tab', 1)))
            },
            select(id) {
                this.selectedId = id
            },
            isSelected(id) {
                return this.selectedId === id
            },
            whichChild(el, parent) {
                return Array.from(parent.children).indexOf(el) + 1
            }
        }" x-id="['tab']">

        <!-- Tab List -->
        <ul x-ref="tablist" @keydown.right.prevent.stop="$focus.wrap().next()"
            @keydown.home.prevent.stop="$focus.first()" @keydown.page-up.prevent.stop="$focus.first()"
            @keydown.left.prevent.stop="$focus.wrap().prev()" @keydown.end.prevent.stop="$focus.last()"
            @keydown.page-down.prevent.stop="$focus.last()" role="tablist"
            class="flex flex-wrap -mb-px text-sm font-medium text-center">

            @foreach ($tabs as $tab)
                <li>
                    <button :id="$id('tab', whichChild($el.parentElement, $refs.tablist))" @click="select($el.id)"
                        @mousedown.prevent @focus="select($el.id)" type="button"
                        :tabindex="isSelected($el.id) ? 0 : -1" :aria-selected="isSelected($el.id)"
                        :class="isSelected($el.id) ? 'border-primary-500' : 'border-transparent'"
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        role="tab">{{ $tab }}</button>
                </li>
            @endforeach
        </ul>

        <div role="tabpanels" class="rounded-lg bg-gray-50 dark:bg-gray-800">
            @foreach ($panels as $panel)
                <section x-show="isSelected($id('tab', whichChild($el, $el.parentElement)))"
                    :aria-labelledby="$id('tab', whichChild($el, $el.parentElement))" role="tabpanel" class="p-8">
                    @foreach ($panel as $block)
                        <x-dynamic-component :component="'blocks.' . $block['type']" :data="$block['data']" />
                    @endforeach
                </section>
            @endforeach
        </div>
    </div>
@endif
