<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use App\Models\Transaction;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CustomerFormEdit extends Component
{

    public $customerId, $name, $email, $telp, $address;


    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:customers,email',
        'telp' => 'required|numeric',
        'address' => 'required|string',
    ];

    public function mount($customerId)
    {
        $customer = Customer::findOrFail($customerId);
        $this->customerId = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->telp = $customer->telp;
        $this->address = $customer->address;

         // Guard
         if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');
    }

    public function updateCustomer()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'email' => "required|email|unique:customers,email,{$this->customerId}",
            'telp' => 'required|numeric',
            'address' => 'required|string',
        ]);

        try {
            $customer = Customer::findOrFail($this->customerId);
            $customer->update($validatedData);

            session()->flash('message', 'Customer updated successfully!');
            session()->flash('message_type', 'success');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to update customer. Please try again.');
            session()->flash('message_type', 'error');
        }
    }

    public function render()
    {
        return view('livewire.customer.customer-form-edit')->layout('components.admin.layout.app', [
            'title' => "Edit Customer $this->name",
            'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
        ]);
    }
}
