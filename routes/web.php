<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')
        ->middleware('permission:dashboard.view')
        ->name('dashboard');

    Route::post('/logout', function (Request $request) {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    })->name('logout');

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::view('/users', 'admin.users.index')
            ->middleware('permission:users.view')
            ->name('users.index');

        Route::view('/products', 'admin.products.index')
            ->middleware('permission:products.view')
            ->name('products.index');

        Route::view('/inventory', 'admin.inventory.index')
            ->middleware('permission:inventory.view')
            ->name('inventory.index');

        Route::view('/purchases', 'admin.purchases.index')
            ->middleware('permission:purchases.view')
            ->name('purchases.index');

        Route::view('/sales', 'admin.sales.index')
            ->middleware('permission:sales.view')
            ->name('sales.index');

        Route::view('/reports', 'admin.reports.index')
            ->middleware('permission:reports.view')
            ->name('reports.index');
    });
});

require __DIR__.'/auth.php';