<?php

use App\Http\Controllers\Front\CategoryController;
use Illuminate\Support\Facades\Route;

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


Route::get('/kategory/{category}', [CategoryController::class, 'category'])->name('category');

Route::get('/{category}/{slug}', [CategoryController::class, 'show'])->name('show');
