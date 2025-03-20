<?php

use App\Http\Controllers\AuthManualController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Livewire\Admin\Category\CreateCategory;
use App\Livewire\Admin\Category\EditCategory;
use App\Livewire\Admin\Category\ShowCategory;
use App\Livewire\Admin\CategoryLivewire;
use App\Livewire\Admin\Report\FinancialIndex;
use App\Livewire\Admin\Report\JobIndex;
use App\Livewire\Admin\Settings;
use App\Livewire\Admin\Transaction\TransactionCreate;
use App\Livewire\Admin\Transaction\TransactionEdit;
use App\Livewire\Admin\Transaction\TransactionIndex;
use App\Livewire\Admin\Transaction\TransactionShow;
use App\Livewire\Admin\Users\UsersCreate;
use App\Livewire\Admin\Users\UsersEdit;
use App\Livewire\Admin\Users\UsersIndex;
use App\Livewire\Admin\Users\UsersShow;
use App\Livewire\Customer\CustomerFormEdit;
use App\Livewire\Home\Homepage\HomepageIndex;
use Illuminate\Support\Facades\Route;

Route::get('/', HomepageIndex::class)->name('home.index');

Route::get('/about', function () {
    return view('about');
});

Route::get('/services', function () {
    return view('services');
});

// Route Dashboard
Route::middleware(['auth', 'check.user.status'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
    Route::get('/admin/dashboard/settings', Settings::class)->name('admin.dashboard.setting');
    Route::get('/admin/report/financial', FinancialIndex::class)->name('admin.dashboard.report.financial');
    Route::get('/admin/report/job', JobIndex::class)->name('admin.dashboard.report.job');
    Route::get('/admin/dashboard/customer-data', [DashboardController::class, 'getCustomerData'])->name('admin.dashboard.customerData');
    Route::get('/admin/dashboard/transaction-data', [DashboardController::class, 'getTransactionData']);
    Route::get('/admin/dashboard/transaction-status-data', [DashboardController::class, 'getTransactionStatusData']);

    // Route::resource('customer', CustomerController::class);
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');

    Route::get('/customer/{customer}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{customerId}/edit', CustomerFormEdit::class)->name('customer.edit');
    // Form edit pelanggan
    Route::put('/customer/{customer}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customer/{customer}', [CustomerController::class, 'destroy'])->name('customer.destroy');

    // Category
    Route::get('/categories', CategoryLivewire::class)->name('category.index');
    Route::get('/categories/create', CreateCategory::class)->name('category.create');
    Route::get('/categories/{id}', ShowCategory::class)->name('category.show');
    Route::get('/categories/{id}/edit', EditCategory::class)->name('category.edit');

    // Users
    Route::get('/users', UsersIndex::class)->name('user.index');
    Route::get('/users/create', UsersCreate::class)->name('user.create');
    Route::get('/users/{id}', UsersShow::class)->name('user.show');
    Route::get('/users/{id}/edit', UsersEdit::class)->name('user.edit');

    // Transaction
    Route::get('/transaction', TransactionIndex::class)->name('transaction.index');
    Route::get('/transaction/create', TransactionCreate::class)->name('transaction.create');
    Route::get('/transaction/{id}', TransactionShow::class)->name('transaction.show');
    Route::get('/transaction/{id}/edit', TransactionEdit::class)->name('transaction.edit');
});

// Route Auth
Route::get('/admin/login', [AuthManualController::class, 'index'])->name('login');
Route::post('/login', [AuthManualController::class, 'login'])->name('auth');
Route::get('/logout', [AuthManualController::class, 'logout'])->name('logout');

