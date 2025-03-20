<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;

class ShowCategory extends Component
{
    public $category;

    public function mount($id)
    {

        $this->category = Category::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.category.show-category')->layout('components.admin.layout.app', ['title' => "Detail Category ". $this->category->name]);
    }
}
