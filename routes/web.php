<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Front\CategoryController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


Route::get('switch', [ArticleController::class, 'switch'])->name('switch');

//auth check
Route::prefix('admin')->middleware('auth')->group(function () {

	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin');
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');

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
