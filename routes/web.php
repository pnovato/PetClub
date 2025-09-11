<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\AdminPetController;
use App\Http\Controllers\Admin\AdminManagerController;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\AdminDonationController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StoreFrontController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () { return view('template.index'); })->name('home');

Route::get('/about', function () { return view('template.about'); })->name('about');

Route::get('/blog', function () { return view('template.blog'); })->name('blog');

Route::get('/contact', function () { return view('template.contact'); })->name('contact');

Route::get('/store', function () {
    return view('template.store');
})->name('store');

Route::get('/PetMember', function () {
    return view('template.PetMember');
})->name('pet_member');

Route::get('/pets', [PetController::class, 'index'])->name('pets.index');
Route::get('/pets/{id}', [PetController::class, 'show'])->name('pet.details');

Route::get('/loja', [LojaController::class, 'index'])->name('loja');
Route::get('/loja/produto/{id}', [LojaController::class, 'show'])->name('produto.show');
Route::post('/loja/comprar', [LojaController::class, 'comprar'])->name('produto.comprar');

Route::get('/checkout/{id}', [PaymentController::class, 'checkout'])->name('checkout');
Route::get('/success', [PaymentController::class, 'success'])->name('checkout.success');
Route::get('/cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel');

Route::get('/store', [StoreFrontController::class, 'index'])->name('public.store');
Route::post('/store/payment', [PaymentController::class, 'process'])->name('store.payment');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');  
})->name('register');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.reset');

Route::view('/dashboard', 'template.dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/admin/teste', function () {
    return 'Bem-vindo, admin!';
})->middleware(['auth', 'admin']);

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () 
{
    Route::get('/dashboard', [AdminPetController::class, 'index'])->name('dashboard');
    Route::resource('pets', AdminPetController::class);
    Route::get('/pets', [AdminPetController::class, 'index'])->name('pets.index');
    Route::get('/pets/create', [AdminPetController::class, 'create'])->name('pets.create');
    Route::post('/pets', [AdminPetController::class, 'store'])->name('pets.store');
    Route::get('/pets/{id}/edit', [AdminPetController::class, 'edit'])->name('pets.edit');
    Route::put('/pets/{id}', [AdminPetController::class, 'update'])->name('pets.update');
    Route::delete('/pets/{id}', [AdminPetController::class, 'destroy'])->name('pets.destroy');
    Route::post('/pets/{id}/approve', [AdminPetController::class, 'approve'])->name('pets.approve');
    Route::post('/pets/{id}/reject', [AdminPetController::class, 'reject'])->name('pets.reject');
    Route::get('/adoptions', [AdminPetController::class, 'adoptions'])->name('pets.adoptions');
    Route::get('/store', [StoreController::class, 'index'])->name('store');
    Route::resource('products', StoreController::class);
    Route::get('/products/create', [StoreController::class, 'create'])->name('products.create');
    Route::post('/products', [StoreController::class, 'store'])->name('products.store');
    Route::delete('/products/{product}', [StoreController::class, 'destroy'])->name('products.destroy');
    Route::get('/products/{id}/edit', [StoreController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [StoreController::class, 'update'])->name('products.update');
    Route::get('/donations', [AdminDonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/{id}/download', [AdminDonationController::class, 'download'])->name('donations.download');
    Route::put('/profile', [AdminManagerController::class, 'updateProfile'])->name('profile.update');
    Route::get('/managers', [AdminManagerController::class, 'index'])->name('managers.index');
    Route::post('/managers', [AdminManagerController::class, 'store'])->name('managers.store');
    Route::delete('/managers/{id}', [AdminManagerController::class, 'destroy'])->name('managers.destroy');
});
Route::middleware(['auth'])->group(function () 
{
    Route::redirect('settings', 'settings/profile');
    Route::get('/pets/{id}/adopt', [PetController::class, 'adopt'])->name('pet.adopt');
    Route::get('/member/donate', [DonationController::class, 'showForm'])->name('donation.form');
    Route::post('/member/donate', [DonationController::class, 'process'])->name('donation.process');
    Route::get('/member/donation/success', [DonationController::class, 'success'])->name('donation.success');
    Route::get('/member/donation/cancel', [DonationController::class, 'cancel'])->name('donation.cancel');
});
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});
Route::middleware('guest')->group(function () 
{
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});
Route::get('/forgot-password', function () 
{
    return view('auth.forgot-password');
})->name('password.reset');
Route::post('/forgot-password', [ForgotPasswordController::class, 'reset'])
    ->name('password.reset.submit');
Route::post('/logout', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');
Route::middleware(['auth','verified'])->group(function () 
{
    Route::view('/dashboard', 'template.dashboard')->name('dashboard');
}); 
Route::get('/email/verify', [VerificationController::class, 'notice'])
    ->middleware('auth')
    ->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');
Route::post('/email/verification-notification', [VerificationController::class, 'send'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

require __DIR__.'/auth.php';
