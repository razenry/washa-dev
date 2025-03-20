<?php

namespace App\View\Components\Admin\Layout;

use App\Models\Transaction;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public int $transactionCount;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->transactionCount = Transaction::where('status', 0)->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.admin.layout.sidebar');
    }
}
