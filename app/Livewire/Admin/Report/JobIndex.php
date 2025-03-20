<?php

namespace App\Livewire\Admin\Report;

use App\Models\DetailTransaction;
use App\Models\Transaction;
use Livewire\Component;

class JobIndex extends Component
{
    public $reports;
    public $total_transaction;

    public function mount()
    {
        $this->reports = DetailTransaction::selectRaw(
            'transactions.id as trans_id,
             transactions.transaction_time,
             users.name as user_name,
             transactions.status as transaction_status'
        )
        ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        ->join('users', 'transactions.user_id', '=', 'users.id') // Join ke tabel users (petugas)
        ->where('transactions.payment_status', '1')
        ->where('transactions.status', '=',  '2')
        ->orWhere('transactions.status', '=', '3')
        ->groupBy('transactions.id', 'transactions.transaction_time', 'users.name', 'transactions.status')
        ->orderBy('transactions.transaction_time', 'DESC')
        ->get();
        $this->total_transaction = Transaction::count();
    }
    public function render()
    {
        return view('livewire.admin.report.job-index')->layout('components.admin.layout.app', [
            'title' => "Job Report"
        ]);
    }
}
