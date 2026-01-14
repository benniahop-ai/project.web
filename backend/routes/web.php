<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoanController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');

    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::post('/books/{book}/loans', [LoanController::class, 'store'])->name('loans.store');
    Route::post('/loans/{loan}/return', [LoanController::class, 'returnBook'])->name('loans.return');

    Route::middleware('admin')->group(function () {
        Route::get('/admin/books', [BookController::class, 'adminIndex'])->name('admin.books.index');
        Route::get('/admin/books/create', [BookController::class, 'create'])->name('admin.books.create');
        Route::post('/admin/books', [BookController::class, 'store'])->name('admin.books.store');
        Route::get('/admin/books/{book}/edit', [BookController::class, 'edit'])->name('admin.books.edit');
        Route::put('/admin/books/{book}', [BookController::class, 'update'])->name('admin.books.update');
        Route::delete('/admin/books/{book}', [BookController::class, 'destroy'])->name('admin.books.destroy');
    });
});
