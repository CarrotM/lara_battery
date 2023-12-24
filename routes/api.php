<?php

use App\Http\Controllers\Api\Cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('brands', [Cars::class, 'GetBrands']); //Получение списка брендов
Route::get('brands/add', [Cars::class, 'AddBrand']); //Получение списка брендов
Route::get('brands/models/list', [Cars::class, 'GetModelsList']); //Получение списка брендов

Route::get('brands/models', [Cars::class, 'GetBrandModels']); //Получение списка брендов

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
