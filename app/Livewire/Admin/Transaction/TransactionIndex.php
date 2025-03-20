<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TransactionIndex extends Component
{
    use WithPagination;

    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];

    public $search = '', $id, $status;

    public Transaction $transaction;

    protected $rules = [
        'transaction.customer_id' => 'required',
    ];

    public function update(string $id)
    {
        // dd($id);

        $this->validate();
        $this->transaction->save();

        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Transaction has been updated to ' . $this->transaction->customer->name,
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        $this->resetPage();
        $this->reset();
    }

    public function mount()
    {
        if (Auth::user()->role != "Officer") {
            return redirect()->route('dashboard.index');
        }

    }

    public function updateStatus(string $id, string $status)
    {

        $transaction = Transaction::findOrFail($id);

        if (!$transaction) {
            session()->flash('error', 'Transaction not found!');
            return;
        }

        $transaction->status = $status;
        $transaction->save();

        $statusLabels = [
            0 => "Draft",
            1 => "Process",
            2 => "Done",
            3 => "Taked"
        ];

        $alert = $statusLabels[$transaction->status] ?? "Unknown";


        $this->dispatch('Alert', [
            'icon' => 'success',
            'title' => 'Updated',
            'text' => 'Status has been updated to ' . $alert,
            'position' => 'center',
            'showConfirmButton' => true,
            'timer' => 1500
        ]);

        $this->dispatch('refreshComponent');

        $this->reset();
    }



    public function delete($id)
    {
        $transaction = Transaction::find($id);
        if ($transaction) {
            $transaction->delete();
            $this->dispatch('Alert', [
                'icon' => 'success',
                'title' => 'Deleted',
                'text' => 'Transaction has been deleted.',
                'position' => 'center',
                'showConfirmButton' => true,
                'timer' => 1500
            ]);

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
        return view('livewire.admin.transaction.transaction-index', [
            'transactions' => Transaction::join('customers', 'transactions.customer_id', '=', 'customers.id')
                ->where(function ($query) {
                    $query->where('customers.name', 'like', '%' . $this->search . '%')
                        ->orWhere('transactions.id', 'like', '%' . $this->search . '%');
                })
                ->where('user_id', '=', Auth::user()->id)
                ->orderBy('transactions.created_at', 'DESC')
                ->paginate(5, ['transactions.*'])
        ])->layout('components.admin.layout.app', [
                    'title' => 'Transaction',
                    'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
                ]);
    }
}
