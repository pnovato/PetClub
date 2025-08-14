<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');  
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.reset');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
});

require __DIR__.'/auth.php';
