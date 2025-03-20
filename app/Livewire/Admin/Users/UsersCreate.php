<?php

namespace App\Livewire\Admin\Users;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;

class UsersCreate extends Component
{
    use WithFileUploads;

    public $name, $email, $password, $password_confirm, $role, $photo;

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
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|same:password_confirm',
            'role' => 'required|in:Admin,Officer',
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.same' => 'Password confirmation does not match.',
            'role.required' => 'Role is required.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'Only JPG, JPEG, PNG, and GIF files are allowed.',
            'photo.max' => 'The photo size cannot exceed 2MB.',
            'photo.required' => 'The photo is required.',
        ]);

        if ($this->photo) {
            $validatedData['photo'] = $this->photo->store('users', 'public');
        }

        $validatedData['password'] = Hash::make($this->password);

        User::create($validatedData);

        $this->reset();
        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'User has been added',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        $this->dispatch('success', message: 'User added successfully!');
        session()->flash('message', 'User added successfully!');
    }

    public function render()
    {
        return view('livewire.admin.users.users-create')->layout('components.admin.layout.app', ['title' => 'Create User']);
    }
}
