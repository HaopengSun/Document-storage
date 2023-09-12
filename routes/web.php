<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentsController;
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

Route::middleware(['auth', 'verified'])->group(function () {
  Route::get('/documents/{folder?}', [DocumentsController::class, 'index'])
    ->where('folder', '(.*)')
    ->name('documents.index');
  Route::post('/create-root-folder', [DocumentsController::class, 'createRootFolder'])->name('folder.create.root');
  Route::get('/get-root-folder', [DocumentsController::class, 'returnRootFolderOfUser'])->name('folder.get.root');
  Route::post('/create-folder', [DocumentsController::class, 'createFolder'])->name('folder.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
