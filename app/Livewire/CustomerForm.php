<?php

namespace App\Livewire;

use App\Models\Customer;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerForm extends Component
{
    public $name, $email, $telp, $address;

    public function mount()
    {
        // Guard
        if (Auth::user()->role != "Officer")
            return redirect()->route('dashboard.index');
    }

    public function customerAdd()
    {
        // Validate input with custom error messages
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'telp' => 'required|numeric',
            'address' => 'required|string',
        ], [
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a text.',
            'name.max' => 'Name cannot exceed 255 characters.',

            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'This email is already registered.',

            'telp.required' => 'Phone number is required.',
            'telp.numeric' => 'Phone number must be numeric.',

            'address.required' => 'Address is required.',
            'address.string' => 'Address must be a text.',
        ]);

        try {
            // Save to database
            $Customer = Customer::create($validatedData);

            // Reset input after submission
            $this->reset();

            // Success flash message
            session()->flash('message', 'Customer added successfully!');
            $this->dispatch('Alert', [
                'icon' => 'success',
                'title' => 'Created',
                'text' => 'User has been created at ' . $Customer->created_at,
                'position' => 'center',
                'showConfirmButton' => true,
            ]);
        } catch (Exception $e) {
            // Error flash message
            session()->flash('error', 'Failed to add customer. Please try again.');
        }
    }

    public function render()
    {
        return view('livewire.customer-form');
    }
}
