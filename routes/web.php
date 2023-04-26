<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Guest\HomeController as GuestHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!!
|
*/

Route::get('/dashboard', [AdminHomeController::class, 'index'])->middleware(['auth'])->name('admin');
Route::get('/', [GuestHomeController::class, 'index'])->name('guest');

Route::middleware('auth')
->prefix('/admin')
->name('admin.')
->group(function() {
    Route::resource('types', TypeController::class);
    Route::resource('projects', ProjectController::class);
});

Route::middleware('auth')
->prefix('profile')
->name('profile.')
->group(function () {
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');
    Route::patch('/', [ProfileController::class, 'update'])->name('update');
    Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
});

require __DIR__.'/auth.php';
