<?php

namespace App\View\Components\Layouts;

use App\Models\Menu;
use Illuminate\View\Component;
use App\Settings\SitesSettings;

class Base extends Component
{
    public $siteSettings;
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SitesSettings $siteSettings)
    {
        $this->siteSettings = $siteSettings;
        $this->menu = Menu::where('activated', true)->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.layouts.base');
    }
}
