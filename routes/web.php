<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\DashboardController;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::middleware([
    'auth',
    'role:admin'
])->group(function () {

    Route::get('/admin/dashboard', [
        DashboardController::class,
        'admin'
    ]);

});


Route::middleware([
    'auth',
    'role:artist'
])->group(function () {

    Route::get('/artist/dashboard', [
        DashboardController::class,
        'artist'
    ]);

});


Route::middleware([
    'auth',
    'role:listener'
])->group(function () {

    Route::get('/dashboard', [
        DashboardController::class,
        'listener'
    ]);

});

Route::middleware('auth')->group(function () {

    Route::get('/discover', function () {

        return Inertia::render(
            'Listener/Discover'
        );

    });

});

Route::middleware(['auth'])->group(function () {

    Route::get('/samples', function () {
        return Inertia::render('Samples/Index');
    })->name('samples.index');

});



// Rute Home / Dashboard
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');

// Rute Search yang sudah kamu buat berfungsi
Route::get('/search', function () {
    return Inertia::render('Search');
})->name('search');

// Rute Explore (Tinggal buat begini nanti)
Route::get('/explore', function () {
    return Inertia::render('Explore');
})->name('explore');