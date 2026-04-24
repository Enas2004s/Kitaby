<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookRequestController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('categories', CategoryController::class);
Route::resource('books', BookController::class);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::post('/books/{book}/request', [BookRequestController::class, 'store'])->name('book-requests.store');

    Route::get('/book-requests', [BookRequestController::class, 'index'])->name('book-requests.index');
    Route::post('/book-requests/{id}/approve', [BookRequestController::class, 'approve'])->name('book-requests.approve');
    Route::post('/book-requests/{id}/reject', [BookRequestController::class, 'reject'])->name('book-requests.reject');

    Route::get('/my-books', [BookController::class, 'myBooks'])->name('books.my');
    Route::get('/my-requests', [BookRequestController::class, 'myRequests'])->name('book-requests.my');
});
