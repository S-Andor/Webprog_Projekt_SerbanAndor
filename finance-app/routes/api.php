<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

//User
Route::get('/users',[App\Http\Controllers\UsersController::class,'index']);
Route::post('/login',[App\Http\Controllers\UsersController::class,'login']);
Route::post('/register',[App\Http\Controllers\UsersController::class,'register']);
Route::get('/check-token',[App\Http\Controllers\UsersController::class,'checkToken']);

//Transaction categories
Route::get('/categories',[App\Http\Controllers\TransactionsController::class,'getAllTransactionCategories']);
Route::post('/transaction',[App\Http\Controllers\TransactionsController::class,'saveTransaction']);
Route::get('/transaction-by-id',[App\Http\Controllers\TransactionsController::class,'getTransactionsById']);
Route::get('/transaction-by-date',[App\Http\Controllers\TransactionsController::class,'getTransactionsByDate']);
Route::get('/list-transaction',[App\Http\Controllers\TransactionsController::class,'getTransactionList']);
Route::get('/balance',[App\Http\Controllers\TransactionsController::class,'getBalance']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
