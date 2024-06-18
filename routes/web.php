<?php

use App\Http\Controllers\ClubController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::resource('clubs', ClubController::class);
Route::get('/clubs_fetchdata', [ClubController::class, 'fetchdata'] );
Route::resource('products', ProductController::class);
Route::get('/products_fetchdata', [ProductController::class, 'fetchdata'] );
