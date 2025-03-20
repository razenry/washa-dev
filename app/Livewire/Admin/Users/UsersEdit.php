<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsersEdit extends Component
{
    use WithFileUploads;

    public $userId, $name, $email, $password, $password_confirm, $role, $photo, $oldPhoto, $user;

    public function mount($id)
    {
        if (Auth::user()->role !== "Admin") {
            return redirect()->route('dashboard.index');
        }

        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->oldPhoto = $user->photo;
        $this->user = $user;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $this->userId,
            'password' => 'nullable|min:6|same:password_confirm',
            'role' => 'required|in:Admin,Officer',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email is already taken.',
            'password.min' => 'Password must be at least 6 characters.',
            'password.confirmed' => 'Password confirmation does not match.',
            'role.required' => 'Role is required.',
            'photo.image' => 'The uploaded file must be an image.',
            'photo.mimes' => 'Only JPG, JPEG, PNG, and GIF files are allowed.',
            'photo.max' => 'The photo size cannot exceed 2MB.',
        ]);

        $user = User::findOrFail($this->userId);

        if ($this->photo) {
            if ($user->photo) {
                Storage::disk('public')->delete($user->photo);
            }
            $validatedData['photo'] = $this->photo->store('users', 'public');
        } else {
            $validatedData['photo'] = $this->oldPhoto;
        }

        if ($this->password) {
            $validatedData['password'] = Hash::make($this->password);
        } else {
            unset($validatedData['password']);
        }

        $user->update($validatedData);

        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'User has been updated',
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        session()->flash('message', 'User updated successfully!');
    }

    public function render()
    {
        return view('livewire.admin.users.users-edit')->layout('components.admin.layout.app');
    }
}
