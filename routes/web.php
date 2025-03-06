<?php

use App\Livewire\ListViewAdmin;
use App\Livewire\Dashboard;
use App\Livewire\EditItem;
use App\Livewire\ListView;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', ListView::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',Dashboard::class)->name('dashboard');
    Route::get('/list-view',ListViewAdmin::class)->name('list-view');
    Route::get('items/edit/{id}', EditItem::class)
    ->middleware(['auth', 'verified'])
    ->name('admin.items.edit');
});
