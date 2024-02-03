<?php

namespace App\View\Components\Layouts;

use Closure;
use App\Models\Menu;
use App\Colors\ColorManager;
use Illuminate\View\Component;
use App\Settings\SitesSettings;

class Base extends Component
{
    public $siteSettings;
    public $menu;
    public $cssVariables = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(SitesSettings $siteSettings)
    {
        $this->siteSettings = $siteSettings;
        $this->menu = Menu::where('activated', true)->get();
        $this->renderStyles();
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

    /**
     * @param  array<string> | null  $packages
     */
    public function renderStyles(?array $packages = null)
    {
        $variables = $this->getCssVariables($packages);

        $colorManager = new ColorManager();
        foreach ($colorManager->getColors() as $name => $shades) {
            foreach ($shades as $shade => $color) {
                $variables["{$name}-{$shade}"] = $color;
            }
        }

        $this->cssVariables = $variables;
    }

    /**
     * @param  array<string> | null  $packages
     * @return array<string, mixed>
     */
    public function getCssVariables(?array $packages = null): array
    {
        $variables = [];

        foreach ($this->cssVariables as $package => $packageVariables) {
            if (
                ($packages !== null) &&
                ($package !== null) &&
                (!in_array($package, $packages))
            ) {
                continue;
            }

            $variables = [
                ...$variables,
                ...$packageVariables,
            ];
        }

        return $variables;
    }
}
