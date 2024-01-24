<?php

namespace App\Livewire;

use App\Models\Menu as MenuModel;
use Livewire\Component;

class Menu extends Component
{
    public $key;
    public $view = null;

    public function render()
    {
        $menu = MenuModel::where('key', $this->key)->first();
        if ($menu) {
            $items = $menu->items;
        } else {
            $items = [];
        }

        if (!empty($this->view)) {
            return view($this->view, [
                "menu" => $items
            ]);
        } else {
            return view('livewire.menu', [
                "menu" => $items
            ]);
        }
    }
}
