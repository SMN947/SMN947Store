<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Models\Category;
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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::resource('dashboard', DashboardController::class)->middleware(['auth']);
Route::resource('products', ProductController::class)->middleware(['auth']);
Route::resource('categories', CategoryController::class)->middleware(['auth']);
Route::resource('pos', PosController::class)->middleware(['auth']);

require __DIR__ . '/auth.php';
