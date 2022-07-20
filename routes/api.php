<?php

use App\Http\Controllers\BookController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/buku', [BookController::class, 'index']);
Route::post('/buku/store', [BookController::class, 'store']);
Route::get('/buku/show/{id}', [BookController::class, 'show']);
Route::post('/buku/update/{id}', [BookController::class, 'update']);
Route::get('/buku/destroy/{id}', [BookController::class, 'destroy']);


