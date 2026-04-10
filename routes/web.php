<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// Halaman About
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Route Dashboard (Hanya untuk yang sudah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Semua Route di dalam group ini membutuhkan Login (Middleware Auth)
Route::middleware('auth')->group(function () {
    
    // Management Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /**
     * ROUTE PRODUCT
     * Prefix 'product' membuat semua URL di bawah diawali dengan /product
     * Name 'product.' membuat semua nama route diawali dengan product.
     */
    Route::prefix('product')->name('product.')->group(function () {
        
        // 1. Route yang bisa diakses SEMUA USER yang sudah login
        Route::get('/', [ProductController::class, 'index'])->name('index'); // URL: /product
        Route::get('/show/{product}', [ProductController::class, 'show'])->name('show'); // URL: /product/show/{id}

        // 2. Route yang HANYA bisa diakses ADMIN (Middleware Gate: manage-product)
        Route::middleware('can:manage-product')->group(function () {
            Route::get('/create', [ProductController::class, 'create'])->name('create'); // URL: /product/create
            Route::post('/store', [ProductController::class, 'store'])->name('store'); // URL: /product/store
            Route::get('/edit/{product}', [ProductController::class, 'edit'])->name('edit'); // URL: /product/edit/{id}
            Route::put('/update/{product}', [ProductController::class, 'update'])->name('update'); // URL: /product/update/{id}
            Route::delete('/delete/{product}', [ProductController::class, 'delete'])->name('delete'); // URL: /product/delete/{id}
        });
    });

});

require __DIR__.'/auth.php';