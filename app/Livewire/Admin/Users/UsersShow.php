<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class UsersShow extends Component
{
    public $user;

    public function mount($id)
    {

        $this->user = User::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.admin.users.users-show')->layout('components.admin.layout.app', [
            'title' =>'Detail User ' . $this->user->name
        ]);
    }
}
