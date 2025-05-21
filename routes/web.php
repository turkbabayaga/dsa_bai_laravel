<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CookieController;
use App\Http\Middleware\ContentSecurityPolicy;
use App\Http\Controllers\LogController;

//Route::middleware([ContentSecurityPolicy::class])->group(function() {
    Route::get('/', function () {
        return view('welcome');
    });
    
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'showUserName'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    Route::resource('idea', IdeaController::class) 
        ->only(['index', 'store', 'edit', 'update', 'destroy']) 
        ->middleware(['auth', 'verified']); 
    
    Route::resource('comments', CommentsController::class) 
        ->only(['index', 'store', 'edit', 'update', 'destroy']) 
        ->middleware(['auth', 'verified']); 
    
    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');
    
    Route::post('/accept-cookies', [CookieController::class, 'acceptCookies']);

    Route::get('/logs', [LogController::class, 'index'])->name('logs.index');

//});

require __DIR__.'/auth.php';
