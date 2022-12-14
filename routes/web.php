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
Route::get('/blog-category/{catId}', [ZenBlogController::class, 'blogCategory'])->name('blog.category');
Route::get('/about', [ZenBlogController::class, 'about'])->name('about');
Route::get('/contact', [ZenBlogController::class, 'contact'])->name('contact');

Route::get('/user-register', [ZenBlogController::class, 'userRegister'])->name('user.register');
Route::post('/user-register', [ZenBlogController::class, 'saveUser'])->name('user.register');

Route::get('/user-login', [ZenBlogController::class, 'userLogin'])->name('user.login');
Route::post('/user-login', [ZenBlogController::class, 'checkLoginUser'])->name('user.login');

Route::get('/user-logout', [ZenBlogController::class, 'userLogout'])->name('user.logout');


Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::post('/new-category', [CategoryController::class, 'saveCategory'])->name('new.category');
    Route::post('/delete-category', [CategoryController::class, 'deleteCategory'])->name('delete.category');

    Route::get('/author', [AuthorController::class, 'index'])->name('author');
    Route::post('/new-author', [AuthorController::class, 'saveAuthor'])->name('new.author');
    Route::post('/edit-author', [AuthorController::class, 'editAuthor'])->name('edit.author');
    Route::post('/update-author', [AuthorController::class, 'updateAuthor'])->name('update.author');

    Route::get('/add-blog', [ BlogController::class, 'index'])->name('add.blog');
    Route::post('/new-blog', [ BlogController::class, 'saveBlog'])->name('new.blog');
    Route::get('/manage-blog', [ BlogController::class, 'manageBlog'])->name('manage.blog');
    Route::post('/edit-blog', [ BlogController::class, 'editBlog'])->name('edit.blog');
    Route::get('/status/{id}', [ BlogController::class, 'status'])->name('status');
    Route::post('/delete.blog', [ BlogController::class, 'deleteBlog'])->name('delete.blog');
});
