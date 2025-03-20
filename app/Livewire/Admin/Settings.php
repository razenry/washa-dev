<?php

namespace App\Livewire\Admin;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;

class Settings extends Component
{
    use WithFileUploads;

    public $user, $email, $password, $photo;

    public function mount()
    {
        $this->user = Auth::user();
        $this->email = $this->user->email;
    }

    public function updateProfile()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->user->id,
            'password' => 'nullable|min:6',
            'photo' => 'nullable|image|max:2048', // Max 2MB
        ]);

        if ($this->photo) {
            $photoPath = $this->photo->store('profile-photos', 'public');
            $this->user->photo = $photoPath;
        }

        if ($this->password) {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->email = $this->email;
        $this->user->save();

        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Profie has been updated',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);
    }

    public function render()
    {
        return view('livewire.admin.settings')->layout('components.admin.layout.app', [
            'title' => "Profile",
            'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
        ]);
    }
}
