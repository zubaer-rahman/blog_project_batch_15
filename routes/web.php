<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ZenBlogController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BlogController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [ZenBlogController::class, 'index'])->name('home');
Route::get('/post-detail/{slug}', [ZenBlogController::class, 'postDetail'])->name('post.detail');
Route::get('/category', [ZenBlogController::class, 'category'])->name('category');
Route::get('/about', [ZenBlogController::class, 'about'])->name('about');
Route::get('/contact', [ZenBlogController::class, 'contact'])->name('contact');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/new-category', [CategoryController::class, 'saveCategory'])->name('new.category');
    //Route::post('/manage-category', [CategoryController::class, 'manageCategory'])->name('manage.category');

    Route::get('/author', [AuthorController::class, 'index'])->name('author');
    Route::post('/new-author', [AuthorController::class, 'saveAuthor'])->name('new.author');
//    Route::post('/manage-author', [AuthorController::class, 'manageAuthor'])->name('manage.author');

    Route::get('/add-blog', [ BlogController::class, 'index'])->name('add.blog');
    Route::post('/new-blog', [ BlogController::class, 'saveBlog'])->name('new.blog');
    Route::get('/manage-blog', [ BlogController::class, 'manageBlog'])->name('manage.blog');
    Route::get('/status/{id}', [ BlogController::class, 'status'])->name('status');
    Route::post('/delete.blog', [ BlogController::class, 'deleteBlog'])->name('delete.blog');
});
