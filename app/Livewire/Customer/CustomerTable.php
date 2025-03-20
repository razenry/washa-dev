<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CustomerTable extends Component
{
    use WithPagination;
    protected $listeners = ['refreshComponent' => '$refresh', 'delete'];
    
    public $search = '', $customer = [];

    public function mount()
    {
         // Guard
         if(Auth::user()->role != "Officer") return redirect()->route('dashboard.index');
    }

    public function delete($id)
    {
        $customer = Customer::find($id);
        if ($customer) {
            $customer->delete();
            session()->flash('message', 'Customer deleted successfully!');
            $this->resetPage();
            $this->reset();
        }
    }

    public function searchCustomers()
    {
        $this->resetPage(); // Reset ke halaman pertama saat mencari
    }

    public function resetSearch()
    {
        $this->search = '';
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.customer.customer-table', [
            'customers' => Customer::where('name', 'like', '%' . $this->search . '%')->orWhere('email', 'like', '%' . $this->search . '%')->paginate(5),
        ]);
    }
}

