<?php

use App\Http\Controllers\Back\ArticleController;
use App\Http\Controllers\Back\AuthController;
use App\Http\Controllers\Back\CategoryController as BackCategoryController;
use App\Http\Controllers\Back\ConfigController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Back\DashboardController;
use App\Http\Controllers\Back\PageController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('sayfa-bakimda', function () {
	return view('front.offline');
});


//auth check
Route::prefix('admin')->middleware('auth')->group(function () {
	Route::get('dashboard', [DashboardController::class, 'index'])->name('admin');
	Route::post('logout', [AuthController::class, 'logout'])->name('logout');

	//Switch for change status
	Route::get('status/switch', [ArticleController::class, 'switch'])->name('switch');

	// Page Settings
	Route::get('pages/index', [PageController::class, 'index'])->name('pages.index');
	Route::get('pages/edit/{id}', [PageController::class, 'edit'])->name('pages.edit');
	Route::post('pages/update', [PageController::class, 'update'])->name('pages.update');
	Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
	Route::post('pages/store', [PageController::class, 'store'])->name('pages.store');
	Route::delete('pages/destroy/{id}', [PageController::class, 'destroy'])->name('pages.destroy');
	Route::get('pages/deleted', [PageController::class, 'deleted'])->name('pages.deleted');
	Route::get('page/recovery{id}', [PageController::class, 'recovery'])->name('page.recovery');
	Route::get('page/hardDelete/{id}}', [PageController::class, 'hardDelete'])->name('page.hard.delete');
	Route::get('page/status/switch', [PageController::class, 'switch'])->name('page.switch');
	Route::get('page/order', [PageController::class, 'order'])->name('page.order');


	//Category

	Route::get('category/edit', [BackCategoryController::class, 'editCategory'])->name('edit.category');
	Route::get('category/edit/update', [BackCategoryController::class, 'updateCategory'])->name('update.category');
	Route::get('category/delete/{id}', [BackCategoryController::class, 'deleteCategory'])->name('delete.category');
	Route::resource('category', BackCategoryController::class);

	//Articles

	Route::get('makaleler/silinenler', [ArticleController::class, 'deleted'])->name('makaleler.silinenler');
	Route::get('recovery/{id}', [ArticleController::class, 'recovery'])->name('recovery');
	Route::get('makale/delete/{id}', [ArticleController::class, 'hardDelete'])->name('hard.delete');
	Route::resource('makaleler', ArticleController::class);


	//Config
	Route::get('ayarlar', [ConfigController::class, 'index'])->name('config.index');
	Route::post('ayarlar/update', [ConfigController::class, 'update'])->name('config.update');
});


//admin/login
Route::prefix('admin')->middleware('isLogin')->group(function () {
	Route::get('login', [AuthController::class, 'login'])->name('login');
	Route::post('login', [AuthController::class, 'loginPost'])->name('loginPost');
});

//just login & register
Route::get('login', [CategoryController::class, 'index']);
Route::get('register', [CategoryController::class, 'index']);

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
