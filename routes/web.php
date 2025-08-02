<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('template.index');
})->name('home');

Route::get('/about', function () {
    return view('template.about');
})->name('about');

Route::get('/blog', function () {
    return view('template.blog');
})->name('blog');

Route::get('/contact', function () {
    return view('template.contact');
})->name('contact');

Route::get('/service', function () {
    return view('template.service');
})->name('service');

Route::get('/PetMember', function () {
    return view('template.PetMember');
})->name('pet_member');

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
