<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
//User
Route::get('/users',[App\Http\Controllers\UsersController::class,'index']);
Route::post('/login',[App\Http\Controllers\UsersController::class,'login']);
Route::get('/check-token',[App\Http\Controllers\UsersController::class,'checkToken']);

//Transaction categories
Route::get('/categories',[App\Http\Controllers\TransactionsController::class,'getAllTransactionCategories']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
