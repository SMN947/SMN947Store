<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PosController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '/{tenant}', 'middleware' => [InitializeTenancyByPath::class]], function () {
    // Routes that require multitenancy middleware
    Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard.home');
    Route::resource('dashboard', DashboardController::class)->middleware(['auth']);
    Route::resource('products', ProductController::class)->middleware(['auth']);
    Route::resource('categories', CategoryController::class)->middleware(['auth']);
    Route::resource('pos', PosController::class)->middleware(['auth']);
    Route::resource('invoice', InvoiceController::class)->middleware(['auth']);
});
