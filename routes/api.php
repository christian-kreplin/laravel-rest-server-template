<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserAuthenticationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [UserAuthenticationController::class, 'login']);
Route::post('register', [UserAuthenticationController::class, 'register']);
Route::post('logout', [UserAuthenticationController::class, 'logout'])->middleware('auth:sanctum');

Route::get('products', [ProductsController::class, 'browse'])->name('products.browse')->middleware('auth:sanctum');
Route::get('products/{product}', [ProductsController::class, 'read'])->name('products.read')->middleware(
    'auth:sanctum'
);
Route::put('products/{product}', [ProductsController::class, 'edit'])->name('products.edit')->middleware(
    'auth:sanctum'
);
Route::post('products', [ProductsController::class, 'add'])->name('products.add')->middleware('auth:sanctum');
Route::delete('products/{product}', [ProductsController::class, 'delete'])->name('products.delete')->middleware(
    'auth:sanctum'
);
