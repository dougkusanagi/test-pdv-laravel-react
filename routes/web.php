<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/products', function () {
//     return Inertia::render('Products');
// })->middleware(['auth', 'verified'])->name('products');

Route::get('/products', [ProductController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('products');

Route::get('/products/create', [ProductController::class, 'create'])
    ->middleware(['auth', 'verified'])
    ->name('products.create');

Route::post('/products/store', [ProductController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('products.store');





// Route::get('/products', function () {
//     return Inertia::render('Products');
// })->middleware(['auth', 'verified'])->name('products');
// Route::resource('products', ProductController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
