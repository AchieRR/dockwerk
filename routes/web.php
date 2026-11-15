<?php

use App\Http\Controllers\PortalController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::middleware('guest')->group(function (): void {
    Route::view('/inloggen', 'auth.login')->name('login');
    Route::post('/inloggen', [SessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function (): void {
    Route::post('/uitloggen', [SessionController::class, 'destroy'])->name('logout');
    Route::get('/portaal', [PortalController::class, 'index'])->name('portal.index');
    Route::get('/portaal/meldingen/nieuw', [PortalController::class, 'create'])->name('portal.create');
    Route::post('/portaal/meldingen', [PortalController::class, 'store'])->name('portal.store');
    Route::get('/portaal/meldingen/{serviceRequest}', [PortalController::class, 'show'])->name('portal.show');
});
