<?php

namespace App\Livewire\Admin\Report;

use App\Models\DetailTransaction;
use Livewire\Component;

class FinancialIndex extends Component
{
    public $reports;

    public function mount()
    {
        $this->reports = DetailTransaction::selectRaw(
            'transactions.id as trans_id,
             transactions.transaction_time,
             customers.name as customer_name,
             SUM(detail_transactions.price * detail_transactions.qty) as grand_total'
        )
        ->join('transactions', 'transactions.id', '=', 'detail_transactions.transaction_id')
        ->join('customers', 'transactions.customer_id', '=', 'customers.id')
        ->where('transactions.payment_status', '1')
        ->where('transactions.status', '=',  '2')
        ->orWhere('transactions.status', '=', '3')
        ->groupBy('transactions.id', 'transactions.transaction_time', 'customers.name')->orderBy('transactions.transaction_time', 'DESC')
        ->with('category')
        ->get();
    }
    public function render()
    {



        // dd($this->reports);
        return view('livewire.admin.report.financial-index')->layout('components.admin.layout.app', [
            'title' => "Financial Report"
        ]);
    }
}
