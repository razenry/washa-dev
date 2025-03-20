<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UsersIndex extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];

    public $search = '';

    public function mount()
    {
        if (Auth::user()->role != "Admin") {
            return redirect()->route('dashboard.index');
        }
    }

    public function toggleStatus($categoryId)
    {
        $category = User::findOrFail($categoryId);
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'User deleted successfully!');
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
        return view('livewire.admin.users.users-index', [
            'users' => User::where('name', 'like', '%' . $this->search . '%')->paginate(5)
        ])->layout('components.admin.layout.app', ['title' => 'User Management']);
    }
}
