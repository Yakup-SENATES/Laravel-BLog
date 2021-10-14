<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CategoryController as BackCategoryController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


//auth check
Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin');
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');

	//Category

	Route::get('category/edit', [BackCategoryController::class, 'editCategory'])->name('edit.category');
	Route::get('category/edit/update', [BackCategoryController::class, 'updateCategory'])->name('update.category');
	Route::get('category/delete/{id}', [BackCategoryController::class, 'deleteCategory'])->name('delete.category');
	Route::resource('category', BackCategoryController::class);

	//Makale
	Route::get('makaleler/silinenler', [ArticleController::class, 'deleted'])->name('makaleler.silinenler');
	Route::get('recovery/{id}', [ArticleController::class, 'recovery'])->name('recovery');
	Route::get('makale/delete/{id}', [ArticleController::class, 'hardDelete'])->name('hard.delete');
	Route::resource('makaleler', ArticleController::class);
});


//admin/login
Route::prefix('admin')->middleware('isLogin')->group(function () {
	Route::get('switch', [ArticleController::class, 'switch'])->name('switch');
	Route::get('login', [AuthController::class, 'login'])->name('login');
	Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');
});

//just login
Route::get('login', [CategoryController::class, 'index']);

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


Route::get('/', [CategoryController::class, 'index'])->name('index');


Route::get('yazilar/sayfa', [CategoryController::class, 'index']);

Route::get('/iletisim', [CategoryController::class, 'contact'])->name('contact');

Route::post('/iletisim', [CategoryController::class, 'contactPost'])->name('contact.post');

Route::get('/{slug}', [CategoryController::class, 'page'])->name('page');

Route::get('/kategory/{category}', [CategoryController::class, 'category'])->name('category');




Route::get('/{category}/{slug}', [CategoryController::class, 'show'])->name('show');

//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
