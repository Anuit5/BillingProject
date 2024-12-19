<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BillingController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::post('/billing/generate', [BillingController::class, 'generateBill'])->name('billing.generate');
Route::get('/billing', [BillingController::class, 'showBillingForm'])->name('billing.form');
//Route::get('/billing/purchases', [BillingController::class, 'viewPurchases'])->name('billing.purchases');
//Route::get('/billing/purchase/{purchaseId}', [BillingController::class, 'showPurchaseDetails'])->name('billing.purchase-details');
Route::get('/previous-purchase/{id}', [BillingController::class, 'viewPreviousPurchase'])->name('billing.previous-purchases');
Route::get('/purchase-details/{purchaseId}', [BillingController::class, 'showPurchaseDetails'])->name('billing.purchase-details');
require __DIR__.'/auth.php';
