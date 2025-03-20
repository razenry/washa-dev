<?php

namespace App\Livewire\Home\Homepage;

use App\Models\Category;
use Livewire\Component;

class HomepageIndex extends Component
{
    public function render()
    {
        return view('livewire.home.homepage.homepage-index', [
            'categories' => Category::where('status', '=', '1')->get()
        ])->layout('components.layout.app', ['title' => 'Homepage']);
    }
}
