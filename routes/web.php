<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DomainController;

use App\Http\Controllers\FinanceController;

use App\Http\Controllers\Industries;

use App\Livewire\Domains;

Route::get('/', [DomainController::class, 'index'])->name('welcome');

Route::get('domains/{domain:url}', [DomainController::class, 'show'])->name('domain.show');

Route::get('industry/{tag}', [Industries::class, 'show'])->name('industry.show');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
 
    Route::get('dashboard', [DomainController::class, 'dashboard'])->name('dashboard');

    Route::get('dashboard/domains/{domain:url}', [DomainController::class, 'edit'])->name('domains.edit');

    Route::get('dashboard/finance', [FinanceController::class, 'userFinance'])->name('dashboard.finance');

    Route::patch('dashboard/domains/{domain:url}', [DomainController::class, 'update'])->name('domains.update');

    Route::post('dashboard/domains', [DomainController::class, 'store'])->name('domains.store');
    
    Route::delete('dashboard/domains/{domain:url}', [DomainController::class, 'destroy'])->name('domains.destroy');

    Route::get('dashboard/domains', Domains::class)->name('dashboard.domains');
 
});
 

require __DIR__.'/auth.php';
