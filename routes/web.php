<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetLoanController;
use App\Http\Controllers\OpnameController;
use App\Http\Controllers\FinanceController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalAssets = \App\Models\Asset::count();
    $deployedAssets = \App\Models\Asset::where('status', 'deployed')->count();
    $availableAssets = \App\Models\Asset::where('status', 'available')->count();
    return view('dashboard', compact('totalAssets', 'deployedAssets', 'availableAssets'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('inventory', AssetController::class)->names('assets')->parameters(['inventory' => 'asset']);

    // Loan Routes
    Route::get('inventory/{asset}/checkout', [AssetLoanController::class, 'create'])->name('loans.create');
    Route::post('inventory/{asset}/checkout', [AssetLoanController::class, 'store'])->name('loans.store');
    Route::post('loans/{loan}/return', [AssetLoanController::class, 'return'])->name('loans.return');

    Route::resource('categories', CategoryController::class);

    // Opname Routes
    Route::prefix('opname')->name('opname.')->group(function () {
        Route::get('/dashboard', [OpnameController::class, 'dashboard'])->name('dashboard');
        Route::get('/riwayat', [OpnameController::class, 'history'])->name('history');
        Route::get('/laporan', [OpnameController::class, 'report'])->name('report');
    });

    // Finance Routes
    Route::prefix('keuangan')->name('finance.')->group(function () {
        Route::get('/dashboard', [FinanceController::class, 'dashboard'])->name('dashboard');
        Route::get('/trial-balance', [FinanceController::class, 'trialBalance'])->name('trial-balance');
        Route::get('/general-ledger', [FinanceController::class, 'generalLedger'])->name('general-ledger');
        Route::get('/profit-loss', [FinanceController::class, 'profitAndLoss'])->name('profit-loss');

        // CRUD Routes
        // Account Routes
        Route::get('/accounts', [FinanceController::class, 'indexAccounts'])->name('accounts.index');
        Route::get('/accounts/create', [FinanceController::class, 'createAccount'])->name('accounts.create');
        Route::post('/accounts', [FinanceController::class, 'storeAccount'])->name('accounts.store');
        Route::get('/accounts/{account}/edit', [FinanceController::class, 'editAccount'])->name('accounts.edit');
        Route::put('/accounts/{account}', [FinanceController::class, 'updateAccount'])->name('accounts.update');
        Route::delete('/accounts/{account}', [FinanceController::class, 'destroyAccount'])->name('accounts.destroy');

        Route::get('/transactions', [FinanceController::class, 'indexTransactions'])->name('transactions.index');
        Route::get('/transactions/create', [FinanceController::class, 'createTransaction'])->name('transactions.create');
        Route::post('/transactions', [FinanceController::class, 'storeTransaction'])->name('transactions.store');
        Route::delete('/transactions/{journal}', [FinanceController::class, 'destroyTransaction'])->name('transactions.destroy');
    });
});

require __DIR__ . '/auth.php';
