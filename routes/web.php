<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// 構造計算システム（テスト用：認証無効）
Route::get('/scheck', function () {
    return view('scheck.index');
})->name('scheck.index');

Route::get('/scheck/environment', function () {
    return view('scheck.environment');
})->name('scheck.environment');

Route::get('/scheck/s-coefficient', function () {
    return view('scheck.s-coefficient');
})->name('scheck.s-coefficient');

Route::get('/scheck/ke-coefficient', function () {
    return view('scheck.ke-coefficient');
})->name('scheck.ke-coefficient');

Route::get('/scheck/eb-coefficient', function () {
    return view('scheck.eb-coefficient');
})->name('scheck.eb-coefficient');

Route::get('/scheck/eg-coefficient', function () {
    return view('scheck.eg-coefficient');
})->name('scheck.eg-coefficient');

Route::get('/scheck/site', function () {
    return view('scheck.site');
})->name('scheck.site');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__ . '/auth.php';
