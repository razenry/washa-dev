<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $name, $price, $type, $photo;

    public function mount()
    {
        if (Auth::user()->role != "Admin") {
            return redirect()->route('dashboard.index');
        }
    }

    public function add()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:0,1',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048', // Foto wajib diisi
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a text.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',

            'type.required' => 'Type is required.',
            'type.in' => 'Invalid type selected.',

            'photo.required' => 'Photo is required.', // Pesan error jika foto kosong
            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'Only JPG, JPEG, PNG, and GIF files are allowed.',
            'photo.max' => 'The photo size cannot exceed 2MB.',
        ]);

        $validatedData['photo'] = $this->photo->store('categories', 'public');

        Category::create($validatedData);

        $this->reset();
        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Category has been added',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        $this->dispatch('success', message: 'Category added successfully!');
        session()->flash('message', 'Category added successfully!');
    }

    public function render()
    {
        return view('livewire.admin.category.create-category')->layout('components.admin.layout.app', ['title' => 'Create Category']);
    }
}
