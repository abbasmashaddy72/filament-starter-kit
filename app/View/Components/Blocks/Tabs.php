<?php

namespace App\View\Components\Blocks;

use Illuminate\View\Component;

class Tabs extends Component
{
    public $items;

    public $tabs = [];

    public $panels = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $modelClass = $data['data'];
        $modelData = app($modelClass);
        $this->items = $modelData
            ->where('status', 'published')
            ->take((int) $data['count'])
            ->get();
        if (!$data['items']) {
            return;
        }
        foreach ($data['items'] as $tab) {
            $this->tabs[] = $tab['title'];
            $this->panels[] = $tab['content'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blocks.tabs');
    }
}
