<?php

namespace App\Livewire\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryLivewire extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];

    public $search = '';

    public function toggleStatus($categoryId)
    {
        $category = Category::findOrFail($categoryId);
        $category->status = $category->status === '1' ? '0' : '1';
        $category->save();
        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Status has been updated',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);
        $this->dispatch('refreshComponent'); // Refresh setelah update status

    }

    public function delete($id)
    {
        $category = Category::find($id);
        if ($category) {
            if ($category->photo) {
                Storage::disk('public')->delete($category->photo);
            }
            $category->delete();
            session()->flash('message', 'Category deleted successfully!');

            $this->resetPage();
            $this->reset();
        }
    }


    public function resetSearch()
    {
        $this->reset();
        $this->resetPage();
        $this->dispatch('refreshComponent');
    }

    public function render()
    {
        return view('livewire.admin.category-livewire', [
            'categories' => Category::where('name', 'like', '%' . $this->search . '%')->paginate(5)
        ])->layout('components.admin.layout.app',['title' => 'Category Management']);
    }
}
