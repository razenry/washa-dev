<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionEdit extends Component
{
    public Transaction $transaction;
    public $customer_id;
    public $search = '';

    protected $rules = [
        'customer_id' => 'required|exists:customers,id',
    ];

    public function mount(String $id)
    {
        $this->transaction = Transaction::findOrFail($id);
        $this->customer_id = $this->transaction->customer_id;
    }

    public function update()
    {
        $this->validate();

        $this->transaction->customer_id = $this->customer_id;
        $this->transaction->save();

        session()->flash('message', 'Transaction updated successfully.');

        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Transaction has been updated to ' . $this->transaction->customer->name,
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);
    }

    public function render()
    {
        return view('livewire.admin.transaction.transaction-edit', [
            'customers' => Customer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->where('status', '=', '1')
                ->get(),
        ])->layout('components.admin.layout.app', [
            'title' => "Edit Transaction " . $this->transaction->id,
            'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
        ]);
    }
}
