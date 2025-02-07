<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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
    return redirect()->route('login');
});
Route::get('/logout', function (Request $request) {
    Session::forget('token');
    Session::forget('user');
    return redirect()->route('login')->with('success', 'Logged out successfully');
})->name('logout');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth.session')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    });
Route::middleware(['auth.session'])->group(function () {
    Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');
    Route::get('/authors/{id}', [AuthorController::class, 'show'])->name('authors.show');
    Route::delete('/authors/{id}', [AuthorController::class, 'destroy'])->name('authors.destroy');
});


Route::middleware(['auth.session'])->group(function () {
    Route::get('/books', [BookController::class, 'index'])->name('books.index');
    Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/books', [BookController::class, 'store'])->name('books.store');
    Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
});