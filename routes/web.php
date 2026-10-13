
<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// Redirect the homepage to the Products page
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Protect routes so only authenticated users can access them
Route::middleware('auth')->group(function () {

    // Product CRUD routes
    Route::resource('products', ProductController::class);

    // Dashboard route
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('verified')->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Load Laravel Breeze authentication routes
require __DIR__.'/auth.php';
