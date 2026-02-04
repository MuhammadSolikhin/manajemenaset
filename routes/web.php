<?php

use App\Http\Controllers\AssetController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssetLoanController;
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
});

require __DIR__ . '/auth.php';
