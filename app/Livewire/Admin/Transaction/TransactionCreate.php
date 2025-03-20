<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionCreate extends Component
{

    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];
    public $search = '', $customer_id;

    public function mount()
    {
        if (Auth::user()->role != "Officer") {
            return redirect()->route('dashboard.index');
        }
    }

    public function add()
    {
        $validatedData = $this->validate([
            'customer_id' => 'required',
        ], [
            'customer_id.required' => 'Customer is required.',
        ]);

        $customerId = $this->customer_id;
        $userId = Auth::user()->id;

        // Ambil transaksi terakhir dari customer yang sama
        $lastTransaction = Transaction::where('customer_id', $customerId)
            ->orderBy('id', 'desc') // Gunakan 'id' karena auto-increment lebih akurat
            ->first();

        // Tentukan nomor transaksi berikutnya
        if ($lastTransaction) {
            // Ambil angka terakhir setelah 'TR-{id_customer}'
            preg_match('/TR-' . $customerId . '(\d+)/', $lastTransaction->transaction_code, $matches);
            $lastNumber = isset($matches[1]) ? (int) $matches[1] : 0;
            $nextNumber = $lastNumber + 1;
        } else {
            $nextNumber = 1; // Jika transaksi pertama
        }

        // Buat kode transaksi unik: TR-{id_customer}{nomor}
        $transactionCode = "TR-" . $customerId . str_pad($nextNumber, 2, "0", STR_PAD_LEFT);

        // Cek apakah transaction_code sudah ada, jika iya tambah 1 lagi
        while (Transaction::where('id', $transactionCode)->exists()) {
            $nextNumber++;
            $transactionCode = "TR-" . $customerId . str_pad($nextNumber, 2, "0", STR_PAD_LEFT);
        }

        // Simpan transaksi baru (tanpa mengisi `id` karena AUTO_INCREMENT)
        Transaction::create([
            'id' => $transactionCode, // Kode transaksi unik
            'customer_id' => $customerId,
            'user_id' => $userId,
            'status' => '0',
            'payment_status' => '0'
        ]);

        $this->reset();

        $this->dispatch('success', message: 'Transaction added successfully!');
        session()->flash('message', 'Transaction added successfully!');
    }


    public function render()
    {
        return view('livewire.admin.transaction.transaction-create', [
            'customers' => Customer::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->where('status', '=', '1')
                ->get()
        ])->layout('components.admin.layout.app', [
                    'title' => 'Create Transaction',
                    'transactionCount' => Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count()
                ]);
    }
}
