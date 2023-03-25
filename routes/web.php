<?php

use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});


Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/authors', [AuthorsController::class, 'index']);
Route::get('authors/books/{author_id}',[AuthorsController::class, 'author_books'])->name('author.books');
Route::get('delete/author/{author_id}',[AuthorsController::class, 'delete_author'])->name('auhtor.delete');

Route::get('book/{author_id}/{book_id}',[AuthorsController::class, 'delete_book'])->name('book.delete');
Route::get('create/book',[AuthorsController::class, 'create_book'])->name('create.book');
Route::post('book/create/process',[AuthorsController::class, 'book_create_process'])->name('book.create.process');