<?php

use App\Livewire\ListViewAdmin;
use App\Livewire\Dashboard;
use App\Livewire\EditItem;
use App\Livewire\AddItem;
use App\Livewire\ListView;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\UserList;
use App\Livewire\AddUser;
use App\Livewire\EditUser;
use App\Livewire\Cart;

Route::get('/', ListView::class)->name('home');
Route::get('/cart', Cart::class)->name('cart');

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
    Route::get('items/edit/{id}', EditItem::class)->name('admin.items.edit');
    Route::get('items/add', AddItem::class)->name('admin.items.add');

    Route::middleware('user.access')->group(function () {
        Route::get('/users', UserList::class)->name('admin.users');
        Route::get('/users/add', AddUser::class)->name('admin.users.add');
        Route::get('/users/edit/{id}', EditUser::class)->name('admin.users.edit');
    });
});

Route::middleware([
    'auth:sanctum',
    'user.access',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/users', UserList::class)->name('admin.users');
    Route::get('/users/add', AddUser::class)->name('admin.users.add');
    Route::get('/users/edit/{id}', EditUser::class)->name('admin.users.edit');
});
