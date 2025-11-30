<?php

use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SaleController;
use App\Http\Controllers\Auth\LoginController;
use App\Livewire\Admin\Dashboard\DashboardIndex;
use App\Livewire\Admin\Product\ProductList;
use App\Livewire\Admin\Product\ProductCreate;
use App\Livewire\Admin\Product\ProductEdit;
use App\Livewire\Admin\Supplier\SupplierList;
use App\Livewire\Admin\Supplier\SupplierCreate;
use App\Livewire\Admin\Supplier\SupplierEdit;
use App\Livewire\Admin\Supplier\SupplierShow;
use App\Livewire\Admin\Expense\ExpenseList;
use App\Livewire\Admin\Expense\ExpenseCreate;
use App\Livewire\Admin\Expense\ExpenseEdit;
use App\Livewire\Admin\Expense\ExpenseShow;
use App\Livewire\Admin\Sale\SaleList;
use App\Livewire\Admin\Sale\SaleCreate;
use App\Livewire\Admin\Sale\SaleEdit;
use App\Livewire\Admin\Sale\SaleShow;
use App\Livewire\Admin\User\UserList;
use App\Livewire\Admin\User\UserCreate;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Admin\Report\ReportIndex;
use App\Models\ExpenseDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('home');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('login');
})->middleware('auth')->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardIndex::class)->name('dashboard');
    
    Route::middleware('role:admin,operator')->group(function () {
        // Products
        Route::get('products', ProductList::class)->name('products.index');
        Route::get('products/create', ProductCreate::class)->name('products.create');
        Route::get('products/{id}/edit', ProductEdit::class)->name('products.edit');
        
        // Suppliers
        Route::get('suppliers', SupplierList::class)->name('suppliers.index');
        Route::get('suppliers/create', SupplierCreate::class)->name('suppliers.create');
        Route::get('suppliers/{id}', SupplierShow::class)->name('suppliers.show');
        Route::get('suppliers/{id}/edit', SupplierEdit::class)->name('suppliers.edit');
        
        // Expenses
        Route::get('expenses', ExpenseList::class)->name('expenses.index');
        Route::get('expenses/create', ExpenseCreate::class)->name('expenses.create');
        Route::get('expenses/{id}', ExpenseShow::class)->name('expenses.show');
        Route::get('expenses/{id}/edit', ExpenseEdit::class)->name('expenses.edit');
        
        // Sales
        Route::get('sales', SaleList::class)->name('sales.index');
        Route::get('sales/create', SaleCreate::class)->name('sales.create');
        Route::get('sales/{id}', SaleShow::class)->name('sales.show');
        Route::get('sales/{id}/edit', SaleEdit::class)->name('sales.edit');
        
        // Reports
        Route::get('reports', ReportIndex::class)->name('reports.index');

        // Export PDF
        Route::get('reports/export-pdf/{type}/{startDate}/{endDate}', [ReportController::class, 'exportPdf'])->name('reports.export-pdf');
        Route::get('expenses/{id}/invoice-pdf', [ExpenseController::class, 'invoicePdf'])->name('expenses.invoice-pdf');
        Route::get('sales/{id}/invoice-pdf', [SaleController::class, 'invoicePdf'])->name('sales.invoice-pdf');
    });
    
    Route::middleware('role:admin')->group(function () {
        Route::get('users', UserList::class)->name('users.index');
        Route::get('users/create', UserCreate::class)->name('users.create');
        Route::get('users/{id}/edit', UserEdit::class)->name('users.edit');
    });
});