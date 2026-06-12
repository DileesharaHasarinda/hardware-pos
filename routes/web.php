<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\MasterCategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\SupplierController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\CustomerGroupController;
use App\Http\Controllers\Admin\UnitController;

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
        Route::resource('sizes', SizeController::class)->except(['show']);
        Route::resource('brands', BrandController::class)->except(['show']);
        Route::resource('master-categories', MasterCategoryController::class)->except(['show']);
        Route::resource('sub-categories', SubCategoryController::class)->except(['show']);
        Route::resource('suppliers', SupplierController::class)->except(['show']);
        Route::resource('customers', CustomerController::class)->except(['show']);
        Route::resource('customer-groups', CustomerGroupController::class)->except(['show']);
        Route::resource('units', UnitController::class)->except(['show']);

        Route::post('/master-categories/quick-store', [MasterCategoryController::class, 'quickStore'])
            ->name('master-categories.quick-store');

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

require __DIR__ . '/auth.php';
