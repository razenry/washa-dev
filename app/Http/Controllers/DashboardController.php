<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {

        $customerPerDay = Customer::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan data untuk Chart.js
        $labels = $customerPerDay->pluck('date')->toArray(); // Label untuk sumbu X (tanggal)
        $data = $customerPerDay->pluck('count')->toArray();  // Data jumlah user per hari

        $customerCount = Customer::count(); // Total semua customer
        $transCount = Transaction::count(); // Total semua customer
        $transactionCount = Transaction::where('status', '=', '0')->where('user_id', '=', Auth::user()->id)->count();
        return view("admin.dashboard.index", compact('labels', 'data', 'transactionCount', 'customerCount', 'transCount'));
    }

    public function getCustomerData(Request $request)
    {
        $filter = $request->query('filter', 'week'); // Default: minggu

        $query = Customer::selectRaw('DATE(created_at) as date, COUNT(*) as count');

        switch ($filter) {
            case 'day':
                $query->whereDate('created_at', now());
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subDays(7));
                break;
            case 'month':
                $query->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $query->groupBy('date')->orderBy('date', 'asc');
        $customerData = $query->get();

        return response()->json([
            'labels' => $customerData->pluck('date')->toArray(),
            'data' => $customerData->pluck('count')->toArray(),
        ]);
    }

    public function getTransactionData(Request $request)
    {
        $filter = $request->query('filter', 'week'); // Default: minggu

        $query = Transaction::selectRaw('DATE(created_at) as date, COUNT(*) as count'); // Jika ingin data per user

        switch ($filter) {
            case 'day':
                $query->whereDate('created_at', now());
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subDays(7));
                break;
            case 'month':
                $query->whereYear('created_at', now()->year)
                    ->whereMonth('created_at', now()->month);
                break;
            case 'year':
                $query->whereYear('created_at', now()->year);
                break;
        }

        $query->groupBy('date')->orderBy('date', 'asc');
        $transactionData = $query->get();

        return response()->json([
            'labels' => $transactionData->pluck('date')->toArray(),
            'data' => $transactionData->pluck('count')->toArray(), // Ambil jumlah transaksi
        ]);
    }

    public function getTransactionStatusData()
    {
        $statusData = Transaction::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return response()->json([
            'labels' => ['Draft', 'Process', 'Done', 'Taked'],
            'data' => [
                $statusData[0] ?? 0, // Draft
                $statusData[1] ?? 0, // Process
                $statusData[2] ?? 0, // Done
                $statusData[3] ?? 0  // Taked
            ]
        ]);
    }

}
