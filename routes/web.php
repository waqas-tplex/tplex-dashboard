<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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

Route::get('/projects-outsourcing', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('projects-outsourcing');

Route::get('/contact-us', function () {
    return Inertia::render('Contact');
});

Route::post('/contact-us', [ContactUsController::class, 'store'])->name('contact-us');

Route::get('/our-team', [RegisteredUserController::class, 'show'])->middleware(['auth', 'verified'])->name('our-team');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
