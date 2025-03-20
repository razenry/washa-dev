<?php

namespace App\Livewire\Admin\Category;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EditCategory extends Component
{
    use WithFileUploads;

    public $id, $name, $price, $type, $photo, $oldPhoto, $category;

    public function mount($id)
    {
        if (Auth::user()->role != "Admin") {
            return redirect()->route('dashboard.index');
        }

        $this->category = Category::findOrFail($id);
        $this->id = $this->category->id;
        $this->name = $this->category->name;
        $this->price = $this->category->price;
        $this->type = $this->category->type;
        $this->oldPhoto = $this->category->photo;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:0,1',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a text.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'price.required' => 'Price is required.',
            'price.numeric' => 'Price must be a number.',
            'price.min' => 'Price cannot be negative.',

            'type.required' => 'Type is required.',
            'type.in' => 'Invalid type selected.',

            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'Only JPG, JPEG, PNG, and GIF files are allowed.',
            'photo.max' => 'The photo size cannot exceed 2MB.',
        ]);

        $category = Category::findOrFail($this->id);

        if ($this->photo) {
            if ($category->photo) {
                Storage::disk('public')->delete($category->photo);
            }
            $validatedData['photo'] = $this->photo->store('categories', 'public');
        } else {
            $validatedData['photo'] = $this->oldPhoto;
        }

        $category->update($validatedData);
        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Category has been updated',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        session()->flash('message', 'Category updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.category.edit-category')->layout('components.admin.layout.app', ['title' => "Edit Category ". $this->category->name]);
    }
}
