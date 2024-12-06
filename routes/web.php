<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DomainController;

use App\Http\Controllers\FinanceController;

use App\Http\Controllers\Industries;

use App\Http\Controllers\Payment;
use App\Http\Controllers\VerifyTransaction;
use App\Livewire\Domains;

Route::get('/', [DomainController::class, 'index'])->name('index');

Route::get('faqs', function () { return view('faqs'); })->name('faqs');

Route::get('privacy-policy', function () { return view('privacy'); })->name('privacy');

Route::get('about-us', function () { return view('about'); })->name('about');

Route::get('terms-of-use', function () { return view('terms'); })->name('terms');

Route::get('contact-us', function () { return view('contact'); })->name('contact');

Route::get('refund', function () { return view('refund'); })->name('refund');

Route::get('buyer-terms', function () { return view('buyer-terms'); })->name('buyer-terms');

Route::get('seller-terms', function () { return view('seller-terms'); })->name('seller-terms');

Route::get('domains/{domain:url}', [DomainController::class, 'show'])->name('domain.show');

Route::get('browse-domains', [DomainController::class, 'browse'])->name('domain.browse');

Route::get('industry/{tag}', [Industries::class, 'show'])->name('industry.show');

Route::get('search', [DomainController::class, 'search'])->name('domain.search');

Route::post('pay', [Payment::class, 'processPayment'])->name('payment');

Route::get('verifytx', [VerifyTransaction::class, 'verifytx'])->name('verifytx');

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
