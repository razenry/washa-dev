<?php

namespace App\Livewire\Admin\Transaction;

use App\Models\Category;
use App\Models\DetailTransaction;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TransactionShow extends Component
{
    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];

    public $id;
    public $pay;
    public $change;
    public $transaction;
    public $detail_transaction;
    public $total_price;
    public $categories = [];
    public $category_id, $qty;

    public function mount($id)
    {
        $this->id = $id; // Simpan ID di properti kelas
        $this->transaction = Transaction::findOrFail($this->id);
        $this->detail_transaction = DetailTransaction::selectRaw('category_id, price, SUM(qty) as total_qty, SUM(price * qty) as total_amount')
            ->where('transaction_id', $this->id)
            ->groupBy('category_id', 'price') // Tambahkan price ke GROUP BY agar tidak tercampur
            ->with('category')
            ->get();
        $this->total_price = DetailTransaction::where('transaction_id', '=', $this->id)->sum('total');
        $this->categories = Category::where('status', '=', '1')->get();

        // Cek role pengguna, hanya Officer yang bisa mengakses
        if (Auth::user()->role != "Officer") {
            return redirect()->route('dashboard.index');
        }
    }

    public function payment()
    {
        // Validasi input
        $this->validate([
            'pay' => 'required',
        ]);

        $count = $this->pay - $this->total_price;
        $change = number_format($count, 0, ',', '.') . ' IDR';
        if ($change >= 0) {
            // Update status transaksi
            $this->transaction->payment_status = '1';
            $this->transaction->status = '1';
            $this->transaction->save();
            $this->mount($this->id);
            $this->change = $change;
            $this->dispatch('Alert', [
                'icon' => 'success',
                'title' => 'Payment Successful',
                'text' => "Change: $change",
                'position' => 'center',
                'showConfirmButton' => true
            ]);
        } else {
            $this->mount($this->id);
            $this->dispatch('Alert', [
                'icon' => 'error',
                'title' => 'Payment Failed',
                'text' => 'Insufficient payment amount. Please check again!',
                'position' => 'center',
                'showConfirmButton' => true
            ]);
        }
    }

    public function add()
    {
        try {
            $validatedData = $this->validate([
                'category_id' => 'required',
                'qty' => 'required|integer|min:1',
            ], [
                'category_id.required' => 'Category is required.',
                'qty.required' => 'Quantity is required.',
                'qty.integer' => 'Quantity must be a number.',
                'qty.min' => 'Quantity must be at least 1.',
            ]);

            $category = Category::findOrFail($this->category_id);
            $total = $category->price * $this->qty;

            DetailTransaction::create([
                'transaction_id' => $this->id,
                'category_id' => $this->category_id,
                'qty' => $this->qty,
                'price' => $category->price,
                'total' => $total
            ]);

            session()->flash('success', 'Transaction added successfully!');
            return redirect()->route('transaction.show', $this->id);

        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->dispatch('Alert', [
                'icon' => 'error',
                'title' => 'Missing fields',
                'text' => 'Service failed to added ',
                'position' => 'center',
                'showConfirmButton' => true,
                'timer' => 3500
            ]);
            return redirect()->route('transaction.show', $this->id);
        }
    }

    public function delete($id)
    {
        if ($this->transaction->id && $id) {
            // Cari data detail transaksi berdasarkan transaction_id dan category_id
            $dt = DetailTransaction::where('transaction_id', $this->transaction->id)
                ->where('category_id', $id)
                ->first();

            if ($dt) {
                $dt->delete(); // Hapus data jika ditemukan
                // Refresh komponen agar data di tampilan ikut terupdate
                $this->dispatch('refreshComponent');
                return redirect()->route('transaction.show', $this->id);
            } else {
                $this->dispatch('Alert', [
                    'icon' => 'error',
                    'title' => 'Failed',
                    'text' => 'Transaction detail not found.',
                    'position' => 'center',
                    'showConfirmButton' => true,
                    'timer' => 1500
                ]);
                return redirect()->route('transaction.show', $this->id);
            }
        }
    }

    public function render()
    {

        return view('livewire.admin.transaction.transaction-show')->layout('components.admin.layout.app', [
            'title' => "Transaction ID: " . $this->id,
            'transactionCount' => Transaction::where('status', '0')
                ->where('user_id', Auth::id())
                ->count(),
        ]);
    }
}
